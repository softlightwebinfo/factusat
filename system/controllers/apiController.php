<?php

/**
 * Created by PhpStorm.
 * User: codeunic
 * Date: 15/07/2017
 * Time: 21:04
 */
class apiController extends Controller
{
    private $key = 'aa098a3f325b085353289a9ecae962688deed2ae';

    /**
     * apiController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->key = Hash::getHash(HASH_ALGORITMO, "codeunicApiSystem", HASH_KEY);
    }

    public function index()
    {

    }

    public function municipios($provincia = null)
    {
        header('Content-Type: application/json; charset=UTF-8');
        $datos = array();
        if ($this->is_ajax()) {
            if ($this->is_get()) {
                $municipiosModel = new MunicipiosModel();
                $municipios = $municipiosModel->getAllId($this->get('provincia'));

                $municipiosDatos = array();
                foreach ($municipios as $key => $row) {
                    array_push($municipiosDatos, array(
                        'id' => $row->getId(),
                        'municipio' => $row->getMunicipio()
                    ));
                }
                die(json_encode(array(
                    "response" => $municipiosDatos
                )));
            }
        } else {
            header('HTTP/1.1 500 Internal Server Perreras');
            die(json_encode(array('message' => 'ERROR', 'code' => 1337)));
        }
    }

    public function razas($tipo = null)
    {
        header('Content-Type: application/json; charset=UTF-8');
        $datos = array();
        if ($this->is_ajax()) {
            if ($this->is_get()) {
                $razasModel = new RazasModel();
                $razas = $razasModel->getAllTipo($this->get('tipo'));

                $razasDatos = array();
                foreach ($razas as $key => $row) {
                    array_push($razasDatos, array(
                        'raza' => $row->getRaza()
                    ));
                }
                die(json_encode(array(
                    "response" => $razasDatos
                )));
            }
        } else {
            header('HTTP/1.1 500 Internal Server Perreras');
            die(json_encode(array('message' => 'ERROR', 'code' => 1337)));
        }
    }

    public function sendContacto()
    {
        header('Content-Type: application/json; charset=UTF-8');

        $datos = array('success' => false);
        if ($this->is_ajax()) {
            if ($this->is_post()) {
                $contacto = new ContactoEntity();
                $contacto->setEmail($this->post('email'));
                $contacto->setFk_usuario(null);
                $contacto->setMensaje($this->post('mensaje'));
                $contacto->setNombre($this->post('nombre'));
                $contacto->setFk_provincia($this->post('provincia'));
                $contacto->setFk_municipio($this->post('municipio'));
                if ($contacto->guardar()) {
                    $datos['success'] = true;
                }
            }
            die(json_encode($datos));
        } else {
            header('HTTP/1.1 500 Internal Server Perreras');
            die(json_encode(array('message' => 'ERROR', 'code' => 1337)));
        }
    }

    public function loadPerreraPalma()
    {
        $loadFile = 'http://csmpafotos.palmademallorca.es/cans_cat.js';
        $contentFile = file_get_contents($loadFile);
        ?>
        <script src="<?= src('js/jquery-3.1.1.min.js') ?>"></script>
        <script>
            var animales = [];
            <?=$contentFile;?>
            Animals.map((item, i) => {
                animales.push({
                    id: item.id,
                    raza: item.raza,
                    caracteristicas: item.caracteristicas,
                    jaula: item.jaula,
                    fecha: item.fecha,
                    entrada: item.entrada,
                    situacion: item.situacion
                });
            });
            var animal = JSON.stringify(animales);
            $.ajax({
                url: '<?=base_url("api/importarAnimalesPalma/")?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    animal
                }
            })
        </script>
        <?php
    }

    public function importarAnimalesPalma()
    {
        if ($this->is_ajax()) {
            $perros = json_decode($_POST['animal']);

            $animalesPalma = new AnimalePalmaEntity();
            $table = $animalesPalma->getTable(true);
//            $animalesPalma->truncate();

            foreach ($perros as $key => $row) {
                $id = explode('.', $row->id)[0];
                $animalesPalma = new AnimalePalmaEntity();

                $dom = new DOMDocument();
                $dom->loadHTML($row->situacion);
                $da = $dom->getElementsByTagName('span')->item(0)->attributes[0]->nodeValue;
                $situacion = "";
                switch ($da) {
                    case 'AD': {
                        $situacion = 'Adoptado';
                        break;
                    }
                    case 'AB': {
                        $situacion = 'Abandonado';
                        break;
                    }
                    case 'VA': {
                        $situacion = 'Vagabundo';
                        break;
                    }
                    case 'RE': {
                        $situacion = 'Renuncia';
                        break;
                    }
                    default: {
                        $situacion = 'Abandonado';
                        break;
                    }
                }
                $raza = new RazaAnimalEntity();
                $raza->setTipo('Perro');
                $raza->setRaza($row->raza);
                $raza->save();

                $animalesPalma->setearCampos(array(
                    'referencia' => "p{$id}",
                    'raza' => $row->raza,
                    'desripcion' => '',
                    'nombre' => '',
                    'tipo' => 'Perro',
                    'fk_estado' => $situacion,
                    'fk_usuario' => 5,
                    'foto' => "http://csmpafotos.palmademallorca.es/fotos/{$row->id}"
                ));
                $animalesPalma->save();
            }
        }
    }

    public function loadPerreraInca()
    {
        $url = 'http://canerainca.com/';


        $curl = curl_init();
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_REFERER, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        $str = curl_exec($curl);
        curl_close($curl);

        $html_base = new simple_html_dom();
        $html_base->load($str);
        $anuncios = array();

        /* BUSCAR ANIMAL IMAGEN */
        $images = $html_base->find('.gallery-item .gallery-icon');
        foreach ($images as $key => $row) {
            $image = $row->children[0]->children[0]->attr['src'];
            array_push($anuncios, array(
                'foto' => $image
            ));
        }
        /*BUSCAR ANIMAL CON REFERENCIA*/
        $ref = $html_base->find('.gallery-item figcaption.gallery-caption strong');
        $contador = 0;
        foreach ($ref as $key => $row) {
            $explode = explode(' ', $row->innertext);
            $anuncios[$contador]['referencia'] = $explode[1];
            $contador++;
        }
        $contador = 0;

        /*BUSCAR ANIMAL CON Tod*/
        $ref = $html_base->find('.gallery-item figcaption.gallery-caption');
        $contador = 0;
        foreach ($ref as $key => $row) {
            $datos = $row->innertext;
            $html = htmlentities($datos);
            $exp = explode('</br>', $datos);
            @$entrada = trim(explode(':', $exp[1])[1]);
            @$raza = trim(explode(':', $exp[2])[1]);
            @$caracteristicas = trim(explode(':', $exp[3])[1]);
            @$estado = trim(explode(':', $exp[4])[1]);
            $anuncios[$contador]['fecha'] = $entrada;
            $anuncios[$contador]['raza'] = $raza;
            $anuncios[$contador]['caracteristicas'] = $caracteristicas;
            $anuncios[$contador]['estado'] = $estado;
            $contador++;
        }

        $html_base->clear();
        unset($html_base);
        $animale = new AnimaleIncaEntity();
//        $animale->truncate();
        foreach ($anuncios as $key => $row) {
            $date = explode('/', $row['fecha']);
            if (isset($date[2]) and isset($date[1]) and isset($date[3])) {
                $fecha = new DateTime("{$date[2]}/{$date[1]}/{$date[0]}");
            } else {
                $fecha = new DateTime();
            }
            if ($row['raza'] == "") continue;
            $animale = new AnimaleIncaEntity();
            $animale->setFoto($row['foto']);
            $animale->setRaza($this->loadRaza($row['raza']));
            $animale->setReferencia($row['referencia']);
            $animale->setTipo('Perro');
            $animale->setFk_estado($this->loadEstado($row['estado']));
            $animale->setFecha_entrada($fecha->format('Y-m-d H:i:s'));
            $animale->setFk_usuario(6);
            $animale->save();
//            break;
        }
        die('Se ha terminado el proceso de busqueda');
    }

    private function loadEstado($estado)
    {
        switch ($estado) {
            case 'Vagabunda':
            case 'Vagabund': {
                $estado = 'Vagabundo';
                break;
            }
            case 'Renuncia sense xip':
            case 'Renuncia sense chip': {
                $estado = 'Renuncia sin chip';
                break;
            }
            case 'Renuncia amb xip':
            case 'Renuncia amb chip': {
                $estado = 'Renuncia con chip';
                break;
            }
            case 'Abandonament amb xip':
            case 'Abandonament amb chip': {
                $estado = 'Abandono con chip';
                break;
            }
        }


        return $estado;
    }

    private function loadRaza($raza)
    {

        switch ($raza) {
            case 'Rater': {
                $raza = 'Ratero';
                break;
            }
            case 'Ca de bestia':
            case 'Bestiar': {
                $raza = 'Ca de bestiar';
                break;
            }
            case 'Dàlmata': {
                $raza = 'Dalmata';
                break;
            }
            case 'Bichon Maltes': {
                $raza = 'Bichon Maltes';
                break;
            }
            case 'Mestissa':
            case 'Mestisa':
            case 'Mestis': {
                $raza = 'Mestizo';
                break;
            }
            case 'Mestis Bestiar': {
                $raza = 'Mestizo ca de bestia';
                break;
            }

        }


        return $raza;
    }
}
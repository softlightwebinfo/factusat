import {url} from "./urls";

function VentanaCentrada(theURL, winName, features, myWidth, myHeight, isCenter) { //v3.0
    if (window.screen) if (isCenter) if (isCenter == "true") {
        var myLeft = (screen.width - myWidth) / 2;
        var myTop = (screen.height - myHeight) / 2;
        features += (features != '') ? ',' : '';
        features += ',left=' + myLeft + ',top=' + myTop;
    }
    window.open(theURL, winName, features + ((features != '') ? ',' : '') + 'width=' + myWidth + ',height=' + myHeight);
}

function imprimir_factura(id_factura, descargar = false) {
    let ruta = url(`facturas/imprimir-factura/${localStorage.getItem('user')}/${id_factura}/${descargar}`);
    if (descargar) {
        var a = document.createElement("a");
        a.target = "_blank";
        a.href = ruta;
        a.click();
    } else {
        VentanaCentrada(ruta, 'Factura', '', '1024', '768', 'true');
    }
}

export {VentanaCentrada};
export {imprimir_factura};
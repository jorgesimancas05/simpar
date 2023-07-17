"use strict";
document.addEventListener("DOMContentLoaded", () => {
    const crear = document.querySelector(".addCliente");
    crear.addEventListener("click", () => {
        //modificar el texto del titulo y el boton del formulario
        document.querySelector(".modal-title").innerText="Añadir Cliente";
        document.querySelector(".submit").innerText="Añadir";
        //lamar a la ventana modal de bootstarp
        $("#frmModal").modal("show");
    });
});

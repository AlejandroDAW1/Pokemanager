
const botonRegistro = document.querySelector("#NoCuentaLogin");
const dialogoRegistro = document.querySelector("#RegistroUsuarioDialog");
const botonCerrar = document.querySelector("#cancelarRegistro");

botonRegistro.addEventListener("click", () =>{
    dialogoRegistro.showModal();
});
botonCerrar.addEventListener("click", () =>{
    dialogoRegistro.close();
});



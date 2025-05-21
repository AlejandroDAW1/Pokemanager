document.getElementById('NoCuentaLogin').addEventListener('click', (e) => {
    e.preventDefault();
    document.getElementById('RegistroUsuarioDialog').showModal();
});

document.getElementById('cancelarRegistro').addEventListener('click', () => {
    document.getElementById('RegistroUsuarioDialog').close();
});
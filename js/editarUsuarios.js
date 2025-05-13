const botonesEditar = document.querySelectorAll("#botonEditar");
const dialogoEditarUsuario = document.querySelector("#Dialogo_editarUsuario");
const botonCancelar = document.querySelector("#cancelarEdit");

  botonesEditar.forEach((boton) => {
    boton.addEventListener("click", async () => {
      const userId = boton.dataset.id;

      const response = await fetch(`../includes/ObtenerUsuarios.php?id=${userId}`);
      const user = await response.json();

      if (response.ok) {
        document.querySelector("#editUserId").value = user.id;
        document.querySelector("#editUserName").value = user.nombre;
        document.querySelector("#editUserEmail").value = user.email;
        document.querySelector("#editUserAdmin").checked = user.is_admin === "1";

        dialogoEditarUsuario.showModal();
      } else {
        Swal.fire("Error", user.error || "No se pudo cargar el usuario.", "error");
      }
    });
  });

  botonCancelar.addEventListener("click", () => {
    dialogoEditarUsuario.close();
  });
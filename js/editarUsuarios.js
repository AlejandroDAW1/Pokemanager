const BotonesEditar = document.querySelectorAll("#botonEditar");
const Dialogo_editarUsuario = document.querySelector("#Dialogo_editarUsuario");
const BotonCerrar = document.querySelector("#cancelarEdit");
const BotonGuardar = document.querySelector("#guardarEdit");

BotonesEditar.forEach((boton) => {
  boton.addEventListener("click", async () => {
    const userId = boton.dataset.id;
    const response = await fetch(`../includes/ObtenerUsuarios.php?id=${userId}`);
    const user = await response.json();

    document.querySelector("#editUserId").value = user.id;
    document.querySelector("#editUserName").value = user.nombre;
    document.querySelector("#editUserEmail").value = user.email;
    document.querySelector("#editUserAdmin").checked = user.is_admin === "1";

    Dialogo_editarUsuario.showModal();
  });
});

BotonCerrar.addEventListener("click", () => {
  Dialogo_editarUsuario.close();
});
BotonGuardar.addEventListener("click", async () => {
  const userId = document.querySelector("#editUserId").value;
  const nombre = document.querySelector("#editUserName").value;
  const email = document.querySelector("#editUserEmail").value;
  const isAdmin = document.querySelector("#editUserAdmin").checked ? 1 : 0;

  if (nombre && email) {
    const response = await fetch("../includes/editarUsuarios.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({
        id: userId,
        nombre: nombre,
        email: email,
        is_admin: isAdmin,
      }),
    });

    if (response.ok) {
      alert("Usuario actualizado con éxito.");
      location.reload();
    } else {
      alert("Error al actualizar el usuario.");
    }

    Dialogo_editarUsuario.close();
  } else {
    alert("Por favor, completa todos los campos.");
  }
});
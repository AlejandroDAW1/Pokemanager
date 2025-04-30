const botonAbrir = document.querySelector("#abrirSobre");

botonAbrir.addEventListener("click", () =>{
    fetch("../api/abrirSobres.php")
        .then(response => response.json())
        .then(data => {
            if (!data || data.status !== "success") {
                Swal.fire('Error', data.message , 'error');
                return;
            }
            const pokemons = data.data;
            const sobresAbiertos = document.querySelector("#sobresAbiertos");
            const sobresNum = document.querySelector("#sobresNum");
            sobresNum.innerHTML = Number(sobresNum.innerHTML) - 1;
            sobresAbiertos.innerHTML = "";
            pokemons.forEach(pokemon => {
                const pokemonDiv = document.createElement("div");
                pokemonDiv.classList.add("pokemon-card");
                pokemonDiv.innerHTML = `
                    <img id='imagenPokemon'src="../${pokemon.icon_path}" alt="${pokemon.Name}">
                    <div class='ColeccionPokemon'>
                    <h2 class='pokemonNombre'>${pokemon.Name}</h2>
                    <p class='pokemonTipo'>${pokemon["Type 1"]}</p>
                    <p class='pokemonTipo'>${pokemon["Type 2"]}</p>
                    </div>
                `;
                sobresAbiertos.appendChild(pokemonDiv);

            });
        })
        .catch(error => {
            Swal.fire('Error', error , 'error');
        });
});


const BotonBatalla = document.getElementById("botonBatalla");

BotonBatalla.addEventListener("click", () => {
    const url = "../api/obtenerBatalla.php";
    fetch(url)
        .then(response => response.json())
        .then(data => {
            console.log(data);
            pintarUsuario("usuarioActual", data.data.usuario);
            pintarUsuario("usuarioRival", data.data.rival);
        })
        .catch(error => console.error('Error:', error));
});

function pintarUsuario(usuario, datos) {
    const contenedor = document.getElementById(usuario);
    const tipo = contenedor.querySelector(".tipo");
    tipo.textContent = datos.pokemons[0]["Type 1"];
    tipo.className = "tipo";
    tipo.classList.add(datos.pokemons[0]["Type 1"]);
    const imagenPokemon = contenedor.querySelector(".pokemon img");
    imagenPokemon.src = "../" + datos.pokemons[0].icon_path;
    const nombrePokemon = contenedor.querySelector(".nombre span");
    nombrePokemon.textContent = datos.pokemons[0].Name;
    const porcentajeVidaPokemon = contenedor.querySelector(".vida span");
    porcentajeVidaPokemon.textContent = "100%";
    const barraVidaPokemon = contenedor.querySelector(".barraVida");
    barraVidaPokemon.style.width = "100%";
    const equipoPokemon = contenedor.querySelector(".equipo");
    equipoPokemon.innerHTML = "";
    datos.pokemons.forEach((pokemon, indice) => {
        if (indice === 0) return;
        const imagenPokemon = document.createElement("img");
        imagenPokemon.src = "../" + pokemon.icon_path;
        equipoPokemon.appendChild(imagenPokemon);
    });
}

const tipos = {
    'Normal':    {'Normal': 1,  'Fire': 1,  'Water': 1,  'Electric': 1, 'Grass': 1,  'Ice': 1,   'Fighting': 1, 'Poison': 1, 'Ground': 1, 'Flying': 1, 'Psychic': 1, 'Bug': 1,  'Rock': 0.5, 'Ghost': 0,   'Dragon': 1, 'Dark': 1, 'Steel': 0.5, 'Fairy': 1},
    'Fire':      {'Normal': 1,  'Fire': 0.5,'Water': 0.5,'Electric': 1, 'Grass': 2,  'Ice': 2,   'Fighting': 1, 'Poison': 1, 'Ground': 1, 'Flying': 1, 'Psychic': 1, 'Bug': 2,  'Rock': 0.5, 'Ghost': 1,   'Dragon': 0.5, 'Dark': 1, 'Steel': 2, 'Fairy': 1},
    'Water':     {'Normal': 1,  'Fire': 2,  'Water': 0.5,'Electric': 1, 'Grass': 0.5,'Ice': 1,   'Fighting': 1, 'Poison': 1, 'Ground': 2, 'Flying': 1, 'Psychic': 1, 'Bug': 1,  'Rock': 2,   'Ghost': 1,   'Dragon': 0.5, 'Dark': 1, 'Steel': 1, 'Fairy': 1},
    'Electric':  {'Normal': 1,  'Fire': 1,  'Water': 2,  'Electric': 0.5,'Grass': 0.5,'Ice': 1,  'Fighting': 1, 'Poison': 1, 'Ground': 0, 'Flying': 2, 'Psychic': 1, 'Bug': 1,  'Rock': 1,   'Ghost': 1,   'Dragon': 0.5, 'Dark': 1, 'Steel': 1, 'Fairy': 1},
    'Grass':     {'Normal': 1,  'Fire': 0.5,'Water': 2,  'Electric': 1, 'Grass': 0.5,'Ice': 1,   'Fighting': 1, 'Poison': 0.5,'Ground': 2,'Flying': 0.5,'Psychic': 1, 'Bug': 0.5,'Rock': 2,   'Ghost': 1,   'Dragon': 0.5, 'Dark': 1, 'Steel': 0.5, 'Fairy': 1},
    'Ice':       {'Normal': 1,  'Fire': 0.5,'Water': 0.5,'Electric': 1, 'Grass': 2,  'Ice': 0.5, 'Fighting': 1, 'Poison': 1, 'Ground': 2, 'Flying': 2, 'Psychic': 1, 'Bug': 1,  'Rock': 1,   'Ghost': 1,   'Dragon': 2, 'Dark': 1, 'Steel': 0.5, 'Fairy': 1},
    'Fighting':  {'Normal': 2,  'Fire': 1,  'Water': 1,  'Electric': 1, 'Grass': 1,  'Ice': 2,   'Fighting': 1, 'Poison': 0.5,'Ground': 1, 'Flying': 0.5,'Psychic': 0.5,'Bug': 0.5,'Rock': 2,   'Ghost': 0,   'Dragon': 1, 'Dark': 2, 'Steel': 2, 'Fairy': 0.5},
    'Poison':    {'Normal': 1,  'Fire': 1,  'Water': 1,  'Electric': 1, 'Grass': 2,  'Ice': 1,   'Fighting': 1, 'Poison': 0.5,'Ground': 0.5,'Flying': 1,'Psychic': 1, 'Bug': 1,  'Rock': 0.5, 'Ghost': 0.5, 'Dragon': 1, 'Dark': 1, 'Steel': 0, 'Fairy': 2},
    'Ground':    {'Normal': 1,  'Fire': 2,  'Water': 1,  'Electric': 2, 'Grass': 0.5,'Ice': 1,   'Fighting': 1, 'Poison': 2, 'Ground': 1, 'Flying': 0,'Psychic': 1, 'Bug': 0.5,'Rock': 2,   'Ghost': 1,   'Dragon': 1, 'Dark': 1, 'Steel': 2, 'Fairy': 1},
    'Flying':    {'Normal': 1,  'Fire': 1,  'Water': 1,  'Electric': 0.5,'Grass': 2, 'Ice': 1,   'Fighting': 2, 'Poison': 1, 'Ground': 1, 'Flying': 1,'Psychic': 1, 'Bug': 2,  'Rock': 0.5, 'Ghost': 1,   'Dragon': 1, 'Dark': 1, 'Steel': 0.5, 'Fairy': 1},
    'Psychic':   {'Normal': 1,  'Fire': 1,  'Water': 1,  'Electric': 1, 'Grass': 1,  'Ice': 1,   'Fighting': 2, 'Poison': 2, 'Ground': 1, 'Flying': 1,'Psychic': 0.5,'Bug': 1,  'Rock': 1,   'Ghost': 1,   'Dragon': 1, 'Dark': 0, 'Steel': 0.5, 'Fairy': 1},
    'Bug':       {'Normal': 1,  'Fire': 0.5,'Water': 1,  'Electric': 1, 'Grass': 2,  'Ice': 1,   'Fighting': 0.5,'Poison': 0.5,'Ground': 1,'Flying': 0.5,'Psychic': 2, 'Bug': 1,  'Rock': 1,   'Ghost': 0.5, 'Dragon': 1, 'Dark': 2, 'Steel': 0.5, 'Fairy': 0.5},
    'Rock':      {'Normal': 1,  'Fire': 2,  'Water': 1,  'Electric': 1, 'Grass': 1,  'Ice': 2,   'Fighting': 0.5,'Poison': 1, 'Ground': 0.5,'Flying': 2,'Psychic': 1, 'Bug': 2,  'Rock': 1,   'Ghost': 1,   'Dragon': 1, 'Dark': 1, 'Steel': 0.5, 'Fairy': 1},
    'Ghost':     {'Normal': 0,  'Fire': 1,  'Water': 1,  'Electric': 1, 'Grass': 1,  'Ice': 1,   'Fighting': 1, 'Poison': 1, 'Ground': 1, 'Flying': 1,'Psychic': 2, 'Bug': 1,  'Rock': 1,   'Ghost': 2,   'Dragon': 1, 'Dark': 0.5, 'Steel': 1, 'Fairy': 1},
    'Dragon':    {'Normal': 1,  'Fire': 1,  'Water': 1,  'Electric': 1, 'Grass': 1,  'Ice': 1,   'Fighting': 1, 'Poison': 1, 'Ground': 1, 'Flying': 1,'Psychic': 1, 'Bug': 1,  'Rock': 1,   'Ghost': 1,   'Dragon': 2, 'Dark': 1, 'Steel': 0.5, 'Fairy': 0},
    'Dark':      {'Normal': 1,  'Fire': 1,  'Water': 1,  'Electric': 1, 'Grass': 1,  'Ice': 1,   'Fighting': 0.5,'Poison': 1, 'Ground': 1, 'Flying': 1,'Psychic': 2, 'Bug': 1,  'Rock': 1,   'Ghost': 2,   'Dragon': 1, 'Dark': 0.5, 'Steel': 1, 'Fairy': 0.5},
    'Steel':     {'Normal': 1,  'Fire': 0.5,'Water': 0.5,'Electric': 0.5,'Grass': 1, 'Ice': 2,   'Fighting': 1, 'Poison': 1, 'Ground': 1, 'Flying': 1,'Psychic': 1, 'Bug': 1,  'Rock': 2,   'Ghost': 1,   'Dragon': 1, 'Dark': 1, 'Steel': 0.5, 'Fairy': 2},
    'Fairy':     {'Normal': 1,  'Fire': 0.5,'Water': 1,  'Electric': 1, 'Grass': 1,  'Ice': 1,   'Fighting': 2, 'Poison': 0.5,'Ground': 1,'Flying': 1,'Psychic': 1, 'Bug': 1,  'Rock': 1,   'Ghost': 1,   'Dragon': 2, 'Dark': 2, 'Steel': 0.5, 'Fairy': 1}
};
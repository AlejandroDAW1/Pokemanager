const BotonBatalla = document.getElementById("botonBatalla");
let intervaloBatalla;

BotonBatalla.addEventListener("click", () => {
  if (NoHayRival()) {
    reiniciarBatalla();
    const url = "../api/obtenerBatalla.php";
    fetch(url)
      .then((response) => response.json())
      .then((data) => {
        console.log(data);
        pintarUsuario("usuarioActual", data.data.usuario);
        pintarUsuario("usuarioRival", data.data.rival);

        // Iniciar el ciclo de batalla automático
        iniciarCicloBatalla(data.data.usuario, data.data.rival);
      })
      .catch((error) => console.error("Error:", error));
  }
});

function reiniciarBatalla() {
  const contenedorLog = document.getElementById("log");
  const contenedorBatalla = document.getElementById("containerBatalla");
  const contenedorIniciarBatalla = document.getElementById("comenzarBatalla");
  contenedorLog.innerHTML = "";
  contenedorBatalla.style.display = "flex";
  contenedorIniciarBatalla.style.display = "none";
}

function pintarUsuario(usuario, datos, pokemonsDerrotados = null) {
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

  // Si hay un Pokémon derrotado, añadirlo primero en gris
  pokemonsDerrotados?.forEach((pokemonDerrotado) => {
    const imagenDerrotado = document.createElement("img");
    imagenDerrotado.src = "../" + pokemonDerrotado.icon_path;
    imagenDerrotado.classList.add("pokemon-derrotado");
    equipoPokemon.appendChild(imagenDerrotado);
  });

  // Añadir el resto de Pokémon del equipo
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

function iniciarBatalla(pokemonAtacante, pokemonDefensor) {
  // Obtener los tipos de los Pokemon
  const tipoAtacante = pokemonAtacante["Type 1"];
  const tipoDefensor = pokemonDefensor["Type 1"];
  const multiplicador = tipos[tipoAtacante][tipoDefensor];

  // Determinar si es ataque especial (50% de probabilidad)
  const esAtaqueEspecial = Math.random() < 0.5;

  // Calcular el daño base según el tipo de ataque
  function calcularDanoBase() {
    if (esAtaqueEspecial) {
      // Usar ataque especial y defensa especial
      const ataqueEsp = parseInt(pokemonAtacante["Sp. Atk"]);
      const defensaEsp = parseInt(pokemonDefensor["Sp. Def"]);
      return Math.floor((ataqueEsp / (1 + (defensaEsp / 100))) * 0.5 * multiplicador);
    } else {
      // Usar ataque y defensa normales
      const ataque = parseInt(pokemonAtacante["Attack"]);
      const defensa = parseInt(pokemonDefensor["Defense"]);
      return Math.floor((ataque / (1 + (defensa / 100))) * 0.5);
    }
  }

  const danoBase = calcularDanoBase();
  const danyoFinal = Math.floor(danoBase * multiplicador);
  
  return {
    danoCausado: danyoFinal,
    multiplicador: multiplicador,
    efectividad: obtenerMensajeEfectividad(multiplicador),
    tipoAtaque: esAtaqueEspecial ? "especial" : "físico",
  };
}

function obtenerMensajeEfectividad(multiplicador) {
  switch (multiplicador) {
    case 0:
      return "No afecta";
    case 0.5:
      return "No es muy efectivo";
    case 2:
      return "¡Es super efectivo!";
    default:
      return "Es efectivo";
  }
}

function realizarTurno(pokemonAtacante, pokemonDefensor, contenedorDefensor) {
  const resultado = iniciarBatalla(pokemonAtacante, pokemonDefensor);
  const vidaActual = actualizarVida(contenedorDefensor, resultado.danoCausado);

  // Actualizar el log de batalla con el tipo de ataque
  actualizarLog(
    `${pokemonAtacante.Name} usa ataque ${resultado.tipoAtaque} contra ${pokemonDefensor.Name}. ${resultado.efectividad} (${resultado.danoCausado} daño)`
  );

  return vidaActual <= 0;
}

function actualizarVida(contenedor, dano) {
  const barraVida = contenedor.querySelector(".barraVida");
  const porcentajeSpan = contenedor.querySelector(".vida span");
  const pokemonImg = contenedor.querySelector(".pokemon img");

  // Obtener el porcentaje actual y restar el daño
  let porcentajeActual = parseInt(porcentajeSpan.textContent);
  porcentajeActual = Math.max(0, porcentajeActual - dano);

  // Actualizar la barra de vida y el texto
  barraVida.style.width = `${porcentajeActual}%`;
  porcentajeSpan.textContent = `${porcentajeActual}%`;

  // Aplicar efecto de daño
  pokemonImg.style.transform = "scale(1.1)";
  pokemonImg.style.filter =" brightness(0) saturate(100%) invert(19%) sepia(95%) saturate(5425%) hue-rotate(356deg) brightness(91%) contrast(118%)";

  // Remover el efecto después de 500ms
  setTimeout(() => {
    pokemonImg.style.transform = "scale(1)";
    pokemonImg.style.filter = "none";
  }, 300);

  return porcentajeActual;
}

function actualizarLog(mensaje) {
  const log = document.getElementById("log");
  const nuevaEntrada = document.createElement("p");
  log.style.display = "flex";
  nuevaEntrada.textContent = mensaje;
  log.insertBefore(nuevaEntrada, log.lastChild);
}

function iniciarCicloBatalla(datosUsuario, datosRival) {
  let pokemonesUsuario = [...datosUsuario.pokemons];
  let pokemonesRival = [...datosRival.pokemons];
  let pokemonesDerrotadosUsuario = [];
  let pokemonesDerrotadosRival = [];
  let turnoUsuario = true;

  clearInterval(intervaloBatalla);
  intervaloBatalla = setInterval(() => {
    const pokemonAtacante = turnoUsuario
      ? pokemonesUsuario[0]
      : pokemonesRival[0];
    const pokemonDefensor = turnoUsuario
      ? pokemonesRival[0]
      : pokemonesUsuario[0];
    const contenedorDefensor = document.getElementById(
      turnoUsuario ? "usuarioRival" : "usuarioActual"
    );

    const pokemonMuerto = realizarTurno(
      pokemonAtacante,
      pokemonDefensor,
      contenedorDefensor
    );

    if (pokemonMuerto) {
      if (turnoUsuario) {
        const pokemonDerrotado = pokemonesRival.shift();
        pokemonesDerrotadosRival.push(pokemonDerrotado);
        if (pokemonesRival.length > 0) {
          pintarUsuario(
            "usuarioRival",
            { pokemons: pokemonesRival },
            pokemonesDerrotadosRival
          );
        } else {
          finalizarBatalla("¡Has ganado 2 Sobres!");
          agregarSobres(2);
          clearInterval(intervaloBatalla);
          return;
        }
      } else {
        const pokemonDerrotado = pokemonesUsuario.shift();
        pokemonesDerrotadosUsuario.push(pokemonDerrotado);
        if (pokemonesUsuario.length > 0) {
          pintarUsuario(
            "usuarioActual",
            { pokemons: pokemonesUsuario },
            pokemonesDerrotadosUsuario
          );
        } else {
          finalizarBatalla("¡Has perdido la batalla!");
          clearInterval(intervaloBatalla);
          return;
        }
      }
    }
    
    turnoUsuario = !turnoUsuario; 
  }, 300);
}

function finalizarBatalla(mensaje) {
  actualizarLog(mensaje);
  Swal.fire({
    title: mensaje,
    icon: mensaje.includes("ganado") ? "success" : "error",
    confirmButtonText: mensaje.includes("ganado") ? "Obtener" : "Aceptar",
  });
  const botonRepetir = document.getElementById("botonVolver");
  const containerRepetir = document.getElementById("repetir");

  botonRepetir.addEventListener("click", () => {
    mostrarSeccion("comenzarBatalla");
  });
  containerRepetir.style.display = "flex";
}

function mostrarSeccion(seccion) {
  const secciones = ["containerBatalla", "comenzarBatalla", "repetir", "log"];
  secciones.forEach((s) => {
    document.getElementById(s).style.display = s === seccion ? "flex" : "none";
  });
}
function agregarSobres(cantidad) {
  const url = "../api/obtenerSobres.php";
    const data = {
        cantidadSobres: cantidad,
    };
    const options = {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify(data),
    };
    fetch(url, options)
    .then((response) => response.json())
    .then((data) => {
      console.log(data);
    })
    .catch((error) => console.error("Error:", error));
}


function NoHayRival() {
  fetch('../api/obtenerBatalla.php')
    .then(response => response.json())
    .then(data => {
        if (data.status === 'error' && data.swal) {
            Swal.fire({
                title: data.swal.title,
                text: data.swal.text,
                icon: data.swal.icon
            });
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}
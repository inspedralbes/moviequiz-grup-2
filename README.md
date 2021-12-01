[![Open in Visual Studio Code](https://classroom.github.com/assets/open-in-vscode-f059dc9a6f8d3a56e377f745f24479a46679e63a5d9fe6f495e02850cd0d8118.svg)](https://classroom.github.com/online_ide?assignment_repo_id=6494322&assignment_repo_type=AssignmentRepo)
# transversals
Esquema mínim de carpetes pels projectes transversals

És obligatori seguir aquesta estructura tot i que la podeu ampliar.

## Atenció
Un cop comenceu heu de canviar aquesta explicació amb la corresponent al vostre projecte (utilitzant markdown)


# Aquest fitxer ha de contenir com a mínim:
 * Nom dels integrants
 * Nom del projecte
 * Petita descripció
 * URL de producció (quan la tingueu)
 * Estat: (explicació de en quin punt està)


1- Una pàgina index que inclou
	1. Logotip i titol de la web
	2. Una matriu d'imatges de les pelicules mes populars
	3. Un llistat de participants amb un ranking de puntuació (Karma) (llistat enlleçable als perfils d'usuari)
	4. Un area d'inici de sessio o registre d'usuari, en cas de voler donar-se d'alta.


2- Seccio de joc (SPA en frontend + crides a API)
    Es pot jugar estant autenticitat al sistema o no.
	1. Si s'esta autenticat les pelicules que apereixen han de ser pelicules que l'usuari hagi marcat com a favorites (ha d'haver marcat com a minim 10 pelicules).
	2. Si no esta autenticat apereixen 5 pelicules aleatories de les 20 pelicules mes populars entre els usuaris

    El sistema generara una pagina on es mostraran 5 preguntes per 5 pelicules.
	La pregunta consistira en adivinar l'any de la pelicula. Per aixo s'agafara l'any de la pelicula i se li sumen 3 nombres aleatoris d'un vector com aquest [-15, -10, -5, -2, +2, +5, +10, +15].

	Un cop es tinguin les respostes de l'usuari es fara una crida al servidor per a comprobar els resultats. La validacio i la puntuacio el fa el servidor.

	Cada encert suma 3 punts de Karma i cada errada resta 1 punt de Karma.

	Es pot permetre posar un nom a la partida.

	Cada partida s'haura d'emmegatzemar al sistema tot guardant el moment en que s'ha produit, quantes s'han encertat i quantes s'han fallat.


3- Seccio usuaris registrats: (Administracio de "les meves pelicules")
	ATENCIO: Apereixen quan han fet login (a la mateixa pagina)
	a. Els usuaris poden modificar la seva informacio personal.
	b. Els usuaris poden veure quines pelicules tenen actualment marcades como a favorites
	c. Els usuaris poden cercar pelicules a OMDB i han de poder afegir-les a la seva coleccio o esborrar-les.



FUNCIONALITAT:
	- Obtenir pelis (cerca OMDB)
	- Afegir puntuacio i comentari a pelicula 
	- Registre
	- Login
	- Joc
	- Mostrar pelicules que tenia
	- Veure fitxa peli (puntuacio mitja + comentari)
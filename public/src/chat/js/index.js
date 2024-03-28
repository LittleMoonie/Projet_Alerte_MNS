let lastId = 0

window.onload = () => {
    // On va chercher la zone de texte
    let texte = document.querySelector("#messageInput")
    texte.addEventListener("keyup", verifEntree)
    
    // On va chercher le bouton "valid"
    let valid = document.querySelector("#sendButton")
    valid.addEventListener("click", ajoutMessage)

    setInterval(chargeMessages, 1000)
}

function verifEntree(e){
    if(e.key == "Enter"){
        ajoutMessage()
    }
}

function chargeMessages() {
    // On charge les messages en Ajax
    // On instancie XMLHttpRequest
    let xmlhttp = new XMLHttpRequest()

    // On gère la réponse
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4) {
            if (this.status == 200) {
                // On a une réponse
                // On convertit le JSON en objet JS
                let messages = JSON.parse(this.response)

                // On retourne la liste pour traiter l'ID le plus élevé en dernier
                messages.reverse();

                // On récupère la div "discussion"
                let discussion = document.querySelector("#discussion")

                // On boucle sur les messages
                for (let message of messages) {
                    // On transforme la date en objet JS
                    let dateMessage = new Date(message.created_at)

                    // On ajoute le message avant le contenu déjà en place
                    discussion.innerHTML = `<p>${message.pseudo} a écrit le ${dateMessage.toLocaleString()} : ${message.message}</p>` + discussion.innerHTML

                    // On met à jour l'id
                    lastId = message.id
                }
            }else{
                // On gère les erreurs
                let erreur = JSON.parse(this.response)
                alert(erreur.message)
            }
        }
    }

    // On ouvre la requête
    xmlhttp.open("GET", "ajax/chargeMessages.php?lastId="+lastId)

    // On envoie la requête
    xmlhttp.send()
}

function ajoutMessage() {
    let message = document.querySelector("#messageInput").value
    let channel = document.querySelector("#channelInput").value

    // On vérifie si on a un message
    if (message != "") {
        let donnees = {
            'message': message,
            'channel': channel
        }

        let donneesJson = JSON.stringify(donnees)

        // On envoie les données en POST en Ajax
        let xmlhttp = new XMLHttpRequest()

        // On gère la réponse
        xmlhttp.onreadystatechange = function(){
            if (xmlhttp.readyState == 4) {
                if(xmlhttp.status == 201) {
                    // On a une réponse
                    // On efface le champ texte
                    document.querySelector("#messageInput").value = ""
                }else{
                    // On reçoit une erreur, on l'affiche
                    let reponse = JSON.parse(xmlhttp.responseText)
                    alert(reponse.message)
                }
            }
        }

        // On ouvre la requête
        xmlhttp.open("POST", "ajax/ajoutMessage.php");

        console.log(donneesJson)
        // On envoie la requête avec les données
        xmlhttp.send(donneesJson);
    }
}
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
    let xmlhttp = new XMLHttpRequest()
    
    // On gère la réponse
    xmlhttp.onreadystatechange = function () {
        let userId = document.querySelector("#userInput").value

        if (this.readyState == 4) {
            if (this.status == 200 ||this.status == 201) {
                // On a une réponse
                // On convertit le JSON en objet JS
                let messages = JSON.parse(this.response)
                
                // On retourne la liste pour traiter l'ID le plus élevé en dernier
                messages.reverse();
                
                // On récupère la div "discussion"
                let discussion = document.querySelector("#messagesArea");
                
                // On boucle sur les messages
                for (let message of messages) {
                    let dateMessage = message.message_timestamp

                    const year = dateMessage.substring(0, 4);
                    const month = dateMessage.substring(5, 7);
                    const day = dateMessage.substring(8, 10);
                    const hours = dateMessage.substring(11, 13);
                    const minutes = dateMessage.substring(14, 16);

                    dateMessage = `${day}/${month}/${year} ${hours}:${minutes}`

                    // On ajoute le message
                    if (message.message_sender_id == userId) {
                        discussion.innerHTML +=  
                        `<div class="flex items-end space-x-2 justify-end">
                        <div class="text-right">
                            <div class="text-light_surface_text font-medium">${message.user_firstname+" "+message.user_lastname}</div>
                                <p class="bg-subtle_highlight text-light_surface_text text-lg font-medium rounded-message_button break-all p-2 max-w-md">${message.message_content}</p>
                                <p class="text-light_surface_text font-normal text-xs">${dateMessage}</p>
                            </div>
                            <img src="${'../../../upload/sm_'+message.user_picture}" alt="Avatar" class="h-10 w-10 rounded-full mb-4">
                        </div>`
                    }
                    else {
                        discussion.innerHTML +=  
                        `<div class="flex items-start space-x-2">
                            <img src="${'../../../upload/sm_'+message.user_picture}" alt="Avatar" class="h-10 w-10 rounded-full mb-4">
                            <div class="text-left">
                                <div class="text-light_surface_text font-medium">${message.user_firstname+" "+message.user_lastname}</div>
                                <p class="bg-subtle_highlight text-light_surface_text text-lg font-medium rounded-message_button break-all p-2 max-w-md">${message.message_content}</p>
                                <p class="text-light_surface_text font-normal text-xs">${dateMessage}</p>
                            </div>
                        </div>`
                    }
                    // On met à jour l'id
                    lastId = message.message_id

                    const messagesArea = document.querySelector("#messagesArea");
                    messagesArea.scrollTop = messagesArea.scrollHeight; // Scroll to the bottom to show the new message
                }
            }
            else{
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
    let user = document.querySelector("#userInput").value

    // On vérifie si on a un message
    if (message.trim() != "") { //     message != "" && message != "\n"
        const date = new Date();
        
        let donnees = {
            'message': message,
            'channel': channel,
            'user': user,
            'timestamp': `${date.getFullYear()}-${date.getMonth()+1}-${date.getDate()} ${date.getHours()}:${date.getMinutes()}:${date.getSeconds()}`
        }
        
        let donneesJson = JSON.stringify(donnees)
        
        // On envoie les données en POST en Ajax
        let xmlhttp = new XMLHttpRequest()
        
        // On gère la réponse
        xmlhttp.onreadystatechange = function(){
            if (xmlhttp.readyState == 4) {
                if(xmlhttp.status == 201) {
                    document.querySelector("#messageInput").value = "";
                }else{
                    let reponse = JSON.parse(xmlhttp.responseText)
                    alert(reponse.message)
                }
            }
        }
        
        // On ouvre la requête
        xmlhttp.open("POST", "ajax/ajoutMessage.php");
        
        // On envoie la requête avec les données
        xmlhttp.send(donneesJson);
    }
    else {
        document.querySelector("#messageInput").value = ""
    }
}
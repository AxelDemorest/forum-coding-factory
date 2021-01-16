var xhr = new XMLHttpRequest();

var voteNumber = document.getElementById("voteNumberContentTopic");

var linkVoteUp = document.getElementById("linkVoteUp");

function voteTopic(topicID, status, userID, idCreatorTopic) {

    /* var buttonVoteUp = document.getElementById("linkVoteUp"); */

    xhr.onreadystatechange = function() {

        if (xhr.readyState == 4 && xhr.status == 200) {

            let dataElements = JSON.parse(xhr.responseText);

            voteNumber.innerHTML = dataElements.valeur1;

            document.getElementById('vote-img-up-topic').src = dataElements.srcUp;

            document.getElementById('vote-img-down-topic').src = dataElements.srcDown;

        }
    };

    xhr.open("POST", 'ajax-folder-topic/voteTopic.php', true);

    xhr.responseType = "text";

    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhr.send("id=" + topicID + "&status=" + status + "&userID=" + userID + "&idCreatorTopic=" + idCreatorTopic);

}

function voteMessage(messageID, status, userID, idCreatorMessage) {

    xhr.onreadystatechange = function() {

        if (xhr.readyState == 4 && xhr.status == 200) {

            let dataElements2 = JSON.parse(xhr.responseText);

            document.getElementById('vote-number-message' + messageID).innerHTML = dataElements2.valeur1;

            document.getElementById('vote-img-up-comments' + messageID).src = dataElements2.srcUp;

            document.getElementById('vote-img-down-comments' + messageID).src = dataElements2.srcDown;

        }
    };

    xhr.open("POST", 'ajax-folder-message/voteMessage.php', true);

    xhr.responseType = "text";

    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhr.send("id=" + messageID + "&status=" + status + "&userID=" + userID + "&idCreatorMessage=" + idCreatorMessage);

}

function bestReply(messageID, topicID) {

    xhr.onreadystatechange = function() {

        if (xhr.readyState == 4 && xhr.status == 200) {

            let dataElements = JSON.parse(xhr.responseText);

            if (typeof(dataElements.valeur1) != 'undefined') {

                document.getElementById('content-message' + dataElements.valeur1).style.border = "none";

                document.getElementById('link-best-answer' + dataElements.valeur1).style.color = "#0d6efd";

                document.getElementById('link-best-answer' + dataElements.valeur1).innerHTML = "<i class='fa fa-check'></i> Choisir comme meilleure solution";
            }

            document.getElementById('link-best-answer' + messageID).style.color = dataElements.valeur2;

            document.getElementById('link-best-answer' + messageID).innerHTML = dataElements.valeur3;

            document.getElementById('content-message' + messageID).style.border = dataElements.valeur4;

        }
    };

    xhr.open("POST", 'ajax-folder-message/bestReply.php', true);

    xhr.responseType = "text";

    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhr.send("messageID=" + messageID + "&topicID=" + topicID);

}
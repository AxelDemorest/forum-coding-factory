var xhr = new XMLHttpRequest();

var voteNumber = document.getElementById("voteNumberContentTopic");

var linkVoteUp = document.getElementById("linkVoteUp");

function voteTopic(topicID, status, userID) {

    /* var buttonVoteUp = document.getElementById("linkVoteUp"); */

    xhr.onreadystatechange = function () {

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

    xhr.send("id=" + topicID + "&status=" + status + "&userID=" + userID);

}

function voteMessage(messageID, status, userID) {

    xhr.onreadystatechange = function () {

        if (xhr.readyState == 4 && xhr.status == 200) {

            let dataElements2 = JSON.parse(xhr.responseText);

            document.getElementById('vote-number-message' + messageID).innerHTML = dataElements2.valeur1;

            document.getElementById('vote-img-up-comments' +  messageID).src = dataElements2.srcUp;

            document.getElementById('vote-img-down-comments' + messageID).src = dataElements2.srcDown;

        }
    };

    xhr.open("POST", 'ajax-folder-message/voteMessage.php', true);

    xhr.responseType = "text";

    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhr.send("id=" + messageID + "&status=" + status + "&userID=" + userID);

}
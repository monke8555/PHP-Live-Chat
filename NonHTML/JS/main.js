function openForm(of) {
  document.getElementById(of).style.display = "block";
}

function closeForm(cf) {
  document.getElementById(cf).style.display = "none";
}

function addFont(elem) {
  var font = elem.innerHTML;
  var location = document.getElementById('msg');
  location.value += ' <font face="' + font + '"> </font>';
}

function additions(toadd) {
  var input = document.getElementById('msg');
  switch(toadd) {
    case "italic":
      input.value += " <i> </i> ";
      break;

    case "bold":
      input.value += " <b> </b> ";
      break;

    case "codeSnippet":
      input.value += " <pre><code> </code></pre>";
      break;
  }
}

function addImage(url) {
  if (include(url, "https://") || include(url, "http://")) {
    message = document.getElementById('msg');
    imgtag = '<img src="' + url + '" alt="Missing" width="500">';
    message.value += imgtag;
  }
}

function checkMobile() {
  var os = GetOS();
  if (os == "Android OS" || os == "iOS") {
    location.href = "http://technopedia.tekcities.com/MainChatMobile.php";
  }
}

function validate(evt) {
  var theEvent = evt;

  // Handle paste
  if (theEvent.type === 'paste') {
      key = event.clipboardData.getData('text/plain');
  } else {
  // Handle key press
      var key = theEvent.keyCode || theEvent.which;
      key = String.fromCharCode(key);
  }
  var regex = /[0-9]|\./;
  if( !regex.test(key) ) {
    theEvent.returnValue = false;
    if(theEvent.preventDefault) theEvent.preventDefault();
  }
}

//alternative for includes() which doesn't work on IE

function include(incstr, tosearch) {
  if (incstr.search(tosearch) != -1) {
    return true;
  } else {
    return false;
  }
}

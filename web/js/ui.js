
  $( function() {
    var dialog, form,
 
      // From http://www.whatwg.org/specs/web-apps/current-work/multipage/states-of-the-type-attribute.html#e-mail-state-%28type=email%29
      emailRegex = /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/,
     /* nom = $( "#name" ),
      email = $( "#email" ),
      password = $( "#password" ),*/
      question = $( "#question" ),
      reponse = $( "#reponse" ),
      allFields = $( [] )/*.add( name ).add( email ).add( password )*/.add( question ).add( reponse ),
      tips = $( ".validateTips" );
 
    function updateTips( t ) {
      tips
        .text( t )
        .addClass( "ui-state-highlight" );
      setTimeout(function() {
        tips.removeClass( "ui-state-highlight", 1500 );
      }, 500 );
    }
 
    /*function checkLength( o, n, min, max ) {
      if ( o.val().length > max || o.val().length < min ) {
        o.addClass( "ui-state-error" );
        updateTips( "Length of " + n + " must be between " +
          min + " and " + max + "." );
        return false;
      } else {
        return true;
      }
    }*/
 
    function checkRegexp( o, regexp, n ) {
      if ( !( regexp.test( o.val() ) ) ) {
        o.addClass( "ui-state-error" );
        updateTips( n );
        return false;
      } else {
        return true;
      }
    }
 
    function addQuestion() {
      var valid = true;
      allFields.removeClass( "ui-state-error" );
 
      /*valid = valid && checkLength( name, "username", 3, 16 );
      valid = valid && checkLength( email, "email", 6, 80 );
      valid = valid && checkLength( password, "password", 5, 16 );*/
 
      /*valid = valid && checkRegexp( name, /^[a-z]([0-9a-z_\s])+$/i, "Username may consist of a-z, 0-9, underscores, spaces and must begin with a letter." );
      valid = valid && checkRegexp( email, emailRegex, "eg. ui@jquery.com" );
      valid = valid && checkRegexp( password, /^([0-9a-zA-Z])+$/, "Password field only allow : a-z 0-9" );*/
 
      if ( valid ) {
        /*$( "#users tbody" ).append( "<tr>" +
          "<td>" + name.val() + "</td>" +
          "<td>" + email.val() + "</td>" +
          "<td>" + password.val() + "</td>" +
        "</tr>" );*/

console.log("question");console.log(question.val());
        
    alert(question.val());
    console.log(question.val());
var password="pass";
var dataa = {
"question":  question.val(),
    "reponse": reponse.val()
};
var quest = 'question';var rep='reponse';
var data2={};
var qq=question.val()+" ";
data2[quest]=qq;
data2[rep]=qq;


var json =JSON.stringify(dataa);
console.log(json);
dialog.dialog( "close" );
$.ajax({
    type: 'POST',
    url: "api/question",
    headers : {
                        
                        'Content-Type' : 'application/json'
                  },
    data: json,
    /*beforeSend: function() { $.mobile.showPageLoadingMsg("b", "Loading...", true) },
    complete: function() { $.mobile.hidePageLoadingMsg() },
    success: function(data) { alert("ajax worked"); },
    error: function(data) {alert("ajax error"); },*/
    success: function(data) { console.log("ajax worked"); },
     error: function(request, status, error, data) {
        
            console.log(request.responseText);
        },
    dataType: 'json'
});




      }
      return valid;
    }
 
    dialog = $( "#dialog-form" ).dialog({
      autoOpen: false,
      height: 400,
      width: 350,
      modal: true,
      buttons: {
        "Créer La Question": addQuestion,
        Cancel: function() {
          dialog.dialog( "close" );
        }
      },
      close: function() {
        form[ 0 ].reset();
        allFields.removeClass( "ui-state-error" );
      }
    });
 
    form = dialog.find( "form" ).on( "submit", function( event ) {
      event.preventDefault();
      addQuestion();
    });
 
    $( "#create-user" ).button().on( "click", function() {
      dialog.dialog( "open" );
    });
  } );

  $( function() {
    $( "#dialog" ).dialog({
      autoOpen: false,
      show: {
        effect: "blind",
        duration: 1000
      },
      hide: {
        effect: "explode",
        duration: 1000
      }
    });
 
    $( "#opener" ).on( "click", function() {
      $( "#dialog" ).dialog( "open" );
    });
  } );
  
document.addEventListener("DOMContentLoaded", function() {
  document.getElementById("sub").addEventListener("click", AjaxAction, false);
}, false);

document.addEventListener("DOMContentLoaded", function() {
  document.getElementById("tweet").addEventListener("click", Tweet, false);
}, false);

function AjaxAction() {
  var input = $(':text[name="input"]').val();
  $.ajax({
    type: 'POST',
    url: 'nyan.php',
    data: {'text1':input},
    async: false,
    success: function(data, dataType)
    {
      $('#output').text(data);
    }
  });
}

function Tweet(){
  window.open('https://twitter.com/intent/tweet?text='+$('#output').text()+'&url=http://ytmn.tech/nyan&hashtags=NyanNyanSocial', '_blank');
}

$(function(){
    $("input").on("keydown", function(e) {
        if ((e.which && e.which === 13) || (e.keyCode && e.keyCode === 13)) {
            AjaxAction();
            return false;
        } else {
            return true;
        }
    });
});

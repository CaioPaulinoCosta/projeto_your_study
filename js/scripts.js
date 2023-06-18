function showMore() {
    var moreText = document.querySelector('.more-text');
    var buttonText = document.querySelector('button');

    if (moreText.style.display === 'none') {
      moreText.style.display = 'block';
      buttonText.textContent = 'Ver Menos';
    } else {
      moreText.style.display = 'none';
      buttonText.textContent = 'Ver Mais';
    }
  }

// Função para exibir a imagem selecionada
function previewImage(input) {
  var preview = document.getElementById('image-preview');
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      preview.style.display = 'block';
      preview.setAttribute('src', e.target.result);
    }
    reader.readAsDataURL(input.files[0]);
  } else {
    preview.style.display = 'none';
    preview.setAttribute('src', 'img/lesson_cover.jpg');
  }
}

// Registrar um evento de alteração no campo de input de arquivo
var imageInput = document.getElementById('lessonImage');
imageInput.addEventListener('change', function() {
  previewImage(this);
});
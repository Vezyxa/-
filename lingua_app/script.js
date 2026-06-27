function flipCard() {
    document.querySelector('.card-body').classList.toggle('flipped');
}

// Функция озвучки слова
function speakWord() {
    const word = document.getElementById('word-text').innerText;
    const utterance = new SpeechSynthesisUtterance(word);
    utterance.lang = 'en-US';
    window.speechSynthesis.speak(utterance);
}

// Простой тест: проверка ввода
function checkAnswer() {
    const input = document.getElementById('answer-input').value.toLowerCase();
    const correct = document.getElementById('correct-answer').value.toLowerCase();
    
    if(input === correct) {
        alert("Правильно! +10 XP");
        // Здесь можно отправить AJAX запрос на обновление прогресса в БД
    } else {
        alert("Ошибка. Попробуй еще раз.");
    }
}

const cards = json_encode(cards) // массив слов
let index = 0;

function update() {
  if(cards.length === 0) {
    document.getElementById('w-front').innerText = "Нет слов";
    document.getElementById('w-back').style.display = 'none';
    return;
  }
  document.getElementById('w-front').innerText = cards[index].word;
  document.getElementById('w-back').innerText = cards[index].translation;
  document.getElementById('w-back').style.display='none';
}
function next() {
  index = (index + 1) % cards.length;
  update();
}
document.getElementById('card').onclick = function() {
  const back = document.getElementById('w-back');
  back.style.display = back.style.display==='none' ? 'block' : 'none';
};
update();



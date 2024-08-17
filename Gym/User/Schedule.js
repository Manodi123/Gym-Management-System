function updateDayTime() {
  var startTime = document.getElementById('day-start').valueAsNumber;
  var endTime = document.getElementById('day-end').valueAsNumber;
  var timeBarWidth = document.querySelector('.day-time .time-bar').offsetWidth;
  var timeBlock = document.getElementById('day-time-block');
  var totalTime = endTime - startTime;
  var blockWidth = (totalTime / (60 * 60 * 1000)) / 24 * timeBarWidth;
  var blockLeft = ((startTime - new Date(startTime).setHours(0, 0, 0, 0)) / (60 * 60 * 1000)) / 24 * timeBarWidth;
  timeBlock.style.width = blockWidth + 'px';
  timeBlock.style.left = blockLeft + 'px';
}

function updateNightTime() {
  var startTime = document.getElementById('night-start').valueAsNumber;
  var endTime = document.getElementById('night-end').valueAsNumber;
  var timeBarWidth = document.querySelector('.night-time .time-bar').offsetWidth;
  var timeBlock = document.getElementById('night-time-block');
  var totalTime = endTime - startTime;
  var blockWidth = (totalTime / (60 * 60 * 1000)) / 24 * timeBarWidth;
  var blockLeft = ((startTime - new Date(startTime).setHours(0, 0, 0, 0)) / (60 * 60 * 1000)) / 24 * timeBarWidth;
  timeBlock.style.width = blockWidth + 'px';
  timeBlock.style.left = blockLeft + 'px';
}

function resetTime(timeType) {
    // Clear the start and end time inputs
    document.getElementById(timeType + '-start').value = '';
    document.getElementById(timeType + '-end').value = '';
    
    // Reset the time block position
    var timeBlock = document.getElementById(timeType + '-time-block');
    timeBlock.style.width = '0';
    timeBlock.style.left = '0';
  }
  
  

  
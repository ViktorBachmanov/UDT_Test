const checkboxWon = document.getElementById('checkbox_won');
setFilter('WON', checkboxWon.checked)

const checkboxLose = document.getElementById('checkbox_lose');
setFilter('LOSE', checkboxLose.checked)

checkboxWon.onchange = function () {  
  setFilter('WON', this.checked)
}

checkboxLose.onchange = function () {  
  setFilter('LOSE', this.checked)
}

function setFilter(name, checked) {
  const $rows = $(`[data-status]:contains('${name}')`).parent()

  if (checked) {
    $rows.removeClass('hidden')
  } else {
    $rows.addClass('hidden')
  }
}
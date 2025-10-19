$("input[data-filter]").each(function() {
  setFilter(this.name, this.checked)

  this.addEventListener('change', function() {
    setFilter(this.name, this.checked)
  })
})

function setFilter(name, checked) {
  const $rows = $(`[data-status]:contains('${name}')`).parent()

  if (checked) {
    $rows.removeClass('hidden')
  } else {
    $rows.addClass('hidden')
  }
}
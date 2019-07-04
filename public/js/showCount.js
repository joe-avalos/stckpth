$(document).ready(()=>{
  $('.js-increment').on('click', e => {
    e.preventDefault()
    let $link = $(e.currentTarget)
    $.ajax({
      method: "POST",
      url: $link.attr('href')
      }
    ).done(data => {
      $('.js-increment-count').html(data.count)
    })
  })
})

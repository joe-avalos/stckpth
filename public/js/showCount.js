$(document).ready(()=>{
  $('.js-increment').on('click', e => {
    e.preventDefault()
    let $link = $(e.currentTarget)
    $.ajax({
      method: "POST",
      url: $link.attr('href')
      }
    ).done(data => {
      let classSelector = '.js-increment-count-'+data.id
      $(classSelector).html(data.count)
    })
  })
})

$(document).on('click','.js-update', e => {
    e.preventDefault()
    let $link = $(e.currentTarget)
    $.ajax({
      method: "POST",
      url: $link.attr('href')
      }
    ).done(data => {
      let classSelector = '.js-product-name-'+data.id
      let html = data.name
      $(classSelector).html(html)
    })
  })
  $(document).on('click','.js-delete', e =>{
    e.preventDefault()
    let $link = $(e.currentTarget)
    $.ajax({
        method: "POST",
        url: $link.attr('href')
      }
    ).done(data=>{
      let classSelector = '.js-product-'+data.id
      $(classSelector).hide()
    })
  })
  $(document).on('submit', '.js-create-form',e =>{
    e.preventDefault()
    let $link = $(e.currentTarget)
    $.ajax({
        method: "POST",
        url: $link.attr('action'),
        data: $link.serialize()
      }
    ).done(data => {
        let html = `<tr class="js-product-${data.id}">
                <td class="js-product-name-${data.id}">${data.name}</td>
                <td>${data.description}</td>
                <td>${data.price}</td>
                <td><a href="/api/delete/${data.id}" class="js-delete">delete</a></td>
                <td><a href="/api/update/${data.id}" class="js-update">update</a></td>
            </tr>`
        $('.js-product-table').append(html)
      }
    )
  })

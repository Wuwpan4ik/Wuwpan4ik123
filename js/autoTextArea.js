
    document.querySelectorAll('.textarea_focus textarea').forEach((item)=>{
        item.addEventListener('input', function (e) {
            e.target.style.height = e.target.scrollHeight + 2 + "px"
            console.log()
        })
    })


    $(".textarea_focus textarea").each(function(textarea) {
        $(this).height( $(this)[0].scrollHeight - 20);
    });
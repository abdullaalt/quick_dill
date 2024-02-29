var tabs = {

    change: function(el){

        let _parent = el.parent()

        _parent.find('.tab').removeClass('active')
        el.addClass('active')
        _parent.next().find('.tab-body').hide()
        _parent.next().find('.tab-'+el.data('body')).show()
        
    }

}
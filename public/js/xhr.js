var xhr = {
	
	endpoint: 'https://test.kod06.ru/api',
	
	sendRequest: function(url, callback, el = null, obj=window, method = "GET", data = null){
		this.showLoader()
		const request = new XMLHttpRequest(); 
		request.open(method, this.endpoint+url, true);
		request.addEventListener("readystatechange", () => {
			xhr.removeLoader()
			//data = JSON.parse(request.response)
			if (request.status > 399 && request.status != 401){
				alert(`Ошибка ${request.status}: ${data.errors}`); 
			}else if (request.readyState === 4) {
				data = JSON.parse(request.response)
				var s = request.status
				obj[callback](s, data, el)
				
			}
		});
				 
			// Выполняем запрос 
			
		request.send(data);
				
		return request
	},

	showLoader: function(){
		$('.loader').show()
	},

	removeLoader: function(){
		$('.loader').hide()
	}
	
}
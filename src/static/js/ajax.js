let ajaxBtn = document.getElementById("testAjaxBtn");
let ajaxPara = document.getElementById("ajaxPara");

ajaxBtn.onclick = function() {
	testAjax();
}

function testAjax() {
	
	const xhr = new XMLHttpRequest();
	xhr.responseType = "json";

	xhr.onreadystatechange = function(event) {
		if (this.readyState === 4) {
	        if (this.status === 200) {
	            //ajaxPara.innerHTML = this.responseText;
	        	//let response = JSON.parse(this.responseText);
	        	let response = this.response;
	        	console.log(response);
	        	
	        } else {
	            console.log("Status de la réponse: %d (%s)", this.status, this.statusText);
	        }
	    }
	};

	xhr.open("GET", "api.php/?c=measures&req=all", true);
	xhr.send(null);
	
}
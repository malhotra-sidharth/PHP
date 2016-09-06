// Initialize Firebase
	  var config = {
	    apiKey: "", //API_KEY
	    authDomain: "", // AUTH_DOMAIN
	    databaseURL: "", // DB_URL
	    storageBucket: "", // STORAGE_BUCKET
	  };
	  firebase.initializeApp(config);

	  var provider = new firebase.auth.GoogleAuthProvider();

	 function openPopUp(){
	 	$("#logInMsg").html("Please wait while we log you in...");
	  	firebase.auth().signInWithPopup(provider).then(function(result) {
			  // This gives you a Google Access Token. You can use it to access the Google API.
			  var token = result.credential.accessToken;
			  // The signed-in user info.
			  var user = result.user;

			  // send data to server and redirect page
			  var url = "" // LOGIN_CHECK_URL
			  $.post(url, 
			  		{ email: user.email, 
			  		  name: user.displayName, 
			  		  uid: user.uid,
			  		  verified: user.emailVerified}, 
			  		function(success){
        				window.location.href = ""; // PROFILE_URL
    				});

			}).catch(function(error) {
			  // Handle Errors here.
			  var errorCode = error.code;
			  var errorMessage = error.message;
			  // The email of the user's account used.
			  var email = error.email;
			  // The firebase.auth.AuthCredential type that was used.
			  var credential = error.credential;
			  // ...
			});
	  }

	 function LogOut(){
	 	firebase.auth().signOut().then(function() {
		  // Sign-out successful.
		  window.location.href = ""; // REDIRECT_AFTER_LOGOUT
		}, function(error) {
		  	alert("Something went wrong!!")
		});
	 }	  
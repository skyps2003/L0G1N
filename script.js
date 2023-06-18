function toggleForm(formType) {
    var loginContainer = document.getElementById("login-container");
    var registerContainer = document.getElementById("register-container");
  
    if (formType === "login") {
      loginContainer.style.display = "block";
      registerContainer.style.display = "none";
    } else if (formType === "register") {
      loginContainer.style.display = "none";
      registerContainer.style.display = "block";
    }
  }
  function toggleForm1(formType) {
    var loginContainer = document.getElementById("login1-container");
    var registerContainer = document.getElementById("register1-container");
  
    if (formType === "login1") {
      loginContainer.style.display = "block";
      registerContainer.style.display = "none";
    } else if (formType === "register1") {
      loginContainer.style.display = "none";
      registerContainer.style.display = "block";
    }
  }
  function showNotification(message, type) {
    const notification = document.createElement('div');
    notification.classList.add('notification');
    notification.classList.add(type);
    notification.textContent = message;

    document.body.appendChild(notification);

  }
  
 
  


  
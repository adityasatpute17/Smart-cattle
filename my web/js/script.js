const body = document.querySelector("body"),
      nav1 = document.querySelector("nav1"),
      searchToggle = document.querySelector(".searchToggle"),
      sidebarOpen = document.querySelector(".sidebarOpen"),
      siderbarClose = document.querySelector(".siderbarClose");

 
      
   //js code to toggle sidebar
sidebarOpen.addEventListener("click" , () =>{
    nav1.classList.add("active");
});

body.addEventListener("click" , e =>{
    let clickedElm = e.target;

    if(!clickedElm.classList.contains("sidebarOpen") && !clickedElm.classList.contains("menu1")){
        nav1.classList.remove("active");
    }
});

//js code to plus icon
function toggleBtn() {
                const Btns = document.querySelector(".btns");
                const add = document.getElementById("add");
                const remove = document.getElementById("remove");
                const btn = document.querySelector(".btns").querySelectorAll("a");
                Btns.classList.toggle("open");
                if (Btns.classList.contains("open")) {
                  remove.style.display = "block";
                  add.style.display = "none";
                  btn.forEach((e, i) => {
                    setTimeout(() => {
                      bottom =60* i;
                      e.style.bottom = bottom + "px";
                      console.log(e);
                    }, 100 * i);
                  });
                } else {
                  add.style.display = "block";
                  remove.style.display = "none";
                  btn.forEach((e, i) => {
                    e.style.bottom = "";
                  });
                }
              }



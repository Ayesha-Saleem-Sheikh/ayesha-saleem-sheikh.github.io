const NRPROJECTS = 2;

const newProjects= [
  { name : "Project 3",htmlName:"Project3/project3.html"},
  {name : "Project 4", htmlName:"Project4/project4.html"},
]

function toggleMenu(){
  const currentDisplay = document.getElementById("myNav");

  if (currentDisplay.style.display =="block"){
    currentDisplay.style.display = "none";
  } else {
    currentDisplay.style.display ="block";
  }
  
}



function Projects(){
  const base = '<li><a href="../Projects/Project2/creative.html">Project 2</a></li>';
  const ul = document.getElementById("projectDisplay");
  for (let i = 0; i < NRPROJECTS && i < newProjects.length; i++) {
    const p = newProjects[i];
     let newLine = base.replace("Project2/creative.html", p.htmlName).replace("Project 2", p.name);
     ul.insertAdjacentHTML("beforeend", newLine);
    }
    }



document.addEventListener("DOMContentLoaded", Projects);
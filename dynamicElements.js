function addElement(divId) {
      var div, newEle, html;
      if (divId == 'study') {
         if (studyCounter > 1) {
            rem = document.getElementById('studyRemove'+studyCounter);
            rem.style.display = "none";
         }
         studyCounter++;
         html = '<label class="smallformlabel smallformblock">Study Number: &nbsp;</label><input type="text" class="studyGroup" name="numbers'+studyCounter+'">'+
            '<a href="#" id="studyRemove'+studyCounter+'" onclick=\'removeElement("irbNumbers'+studyCounter+'");return false;\'>Remove</a>';
         div = document.getElementById(divId);
         newEle = document.createElement('p');
         newEle.setAttribute('id','irbNumbers'+studyCounter);
         newEle.innerHTML = html;
         div.appendChild(newEle);
      } else if (divId == 'personnel') {
         if (personnelCounter > 1) {
            rem = document.getElementById('personRemove'+personnelCounter);
            rem.style.display = "none";
         }
         personnelCounter++;
         html = '<label class="smallformlabel smallformblock">Personnel Name: &nbsp;</label><input type="text" class="personGroup"name="personName'+personnelCounter+'">'+
            '<label class="smallformlabel smallformblock">Personnel Email: &nbsp;</label><input type="text" class="personGroup" name="personEmail'+personnelCounter+'">'+
            '<a href="#" id="personRemove'+personnelCounter+'" onclick=\'removeElement("personnel'+personnelCounter+'");return false;\'>Remove</a>';
         div = document.getElementById(divId);
         newEle = document.createElement('p');
         newEle.setAttribute('id','personnel'+personnelCounter);
         newEle.innerHTML = html;
         div.appendChild(newEle);
      } else {
         entShowTinyBoxWarn('<div class="tinyBoxInfofieldset"><div><p> ---> JavaScipt Error <--- </div></div>');
      }
   }

   function removeElement(id) {
      var ele = document.getElementById(id);
      var rem;
      if (ele.parentNode.id == "study") {
         studyCounter--;
         if (studyCounter > 1) {
         rem = document.getElementById('studyRemove'+studyCounter);
         rem.style.display = "inline";
         }
      } else if (ele.parentNode.id == "personnel") {
         personnelCounter--;
         if (personnelCounter > 1) {
         rem = document.getElementById('personRemove'+personnelCounter);
         rem.style.display = "inline";
         }
      } else {
         //entShowTinyBoxWarn('<div class="tinyBoxInfofieldset"><div><p> ---> JavaScipt Error <--- </div></div>');
      }
      ele.parentNode.removeChild(ele);
   }

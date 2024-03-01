var counter=document.getElementById('counter');
var submit=document.getElementById('submit');
var num=20;
//var checkuser=document.getElementById('checkuser');
//var champion_body=document.getElementById('champion_body');
//var wronganswer=document.getElementById('wronganswer');
//var all_answer=document.getElementById('all_answer');
var time=document.getElementById('time');
function count(){
    num--;
    counter.innerHTML=num;
    if(num==0){
    }
    else{
    setTimeout(count,1000)
    }
}
//submit.onclick=function(){
  //  count();
//}


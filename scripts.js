//------------------для  раздела управления топиками-----------//
var topicman = new Object;
topicman.createProjectsList = function ()
	{
	var ajax = new XMLHttpRequest ();
	var link = 'category.php?project=1';
	ajax.open ("GET", link, false);
	ajax.send(null);
	
	if(topicman.buff)
		{
		topicman.buffid = topicman.buff.id;
		topicman.buffSQLID = topicman.buff.SQLID;
		}
	ajax.onreadystatechange = createProjectsList2(ajax.responseText);
	function createProjectsList2(data)
		{
		var arr = $.parseJSON(data);
		var projectsDiv = document.getElementById('projectsDiv');
		projectsDiv.innerHTML = '';
		var projectsDivTable = document.createElement('table');
		projectsDivTable.className = 'table internalTable';
		projectsDivTable.id = 'projectDivTable';
		projectsDiv.appendChild(projectsDivTable);
		topicman.createAddProjectPanel();
		for (var i=0;i<arr[0].length;i++)
			{
			var tr = document.createElement('div');
			tr.className='tr internalBoxTr tab_body';
			projectsDivTable.appendChild(tr);
			var td1 = document.createElement('div');
			td1.className='td internalBoxTd';
			var td2 = document.createElement('div');
			td2.className='td internalBoxTd internalBoxTd2';
			td2.id = arr[0][i];
			td1.innerHTML = arr[1][i];
			td1.SQLID = arr[0][i];
			td1.onclick = function(){topicman.projAct(this.SQLID,this)};
			td1.id = 'projectSQLID_'+arr[0][i];
			tr.appendChild(td1);
			tr.appendChild(td2);
			var delimg = document.createElement('img');
			delimg.src='../img/delete.png';
			delimg.SQLID = arr[0][i];
			delimg.onclick = function(){topicman.delProject(this.SQLID)};
			td2.appendChild(delimg);
			}
		if(topicman.buff)
			{
			var temp = document.getElementById(topicman.buffid);
			temp.style.fontWeight='bold';
			topicman.buff  = temp;
			}
		}
	}

topicman.delProject = function(id)
	{
	var ajax2 = new XMLHttpRequest ();
	var link = 'category.php?del_project='+id;
	ajax2.open ("GET", link, false);
	ajax2.send(null);
	ajax2.onreadystatechange = topicman.reloadAfterDelProject(id);
	}
topicman.reloadAfterDelProject = function(id)
	{
	if(topicman.buff)
		{
		if (topicman.buff===document.getElementById('projectSQLID_'+id))
			{
			topicsDiv.innerHTML='';
			}
		}
	topicman.createProjectsList ();
	}
topicman.projAct = function(id,el)
	{
	if 	(topicman.buff)
		{
		topicman.buff.style.fontWeight='normal';
		}
	el.style.fontWeight='bold';
	topicman.buff = el;
	topicman.buff.SQLID = el.SQLID;
	topicman.createTopicList(id);
	}
//--------------//
topicman.createTopicList = function(project_id)
	{
	$.get('category.php?topic=1&project_id='+project_id,false,topicman.createTopicList2);
	topicman.lastCreateTopicListId = project_id;
	}
topicman.createTopicList2 = function(date)
	{
	var arr = $.parseJSON(date);
	var ForTopicsDiv = document.getElementById('topicsDiv');
	var topicsDiv = document.createElement('table');
	topicsDiv.id = 'TopicDivTable';
	ForTopicsDiv.innerHTML='';
	ForTopicsDiv.appendChild(topicsDiv);
	topicsDiv.className='internalTable table';
	topicman.createAddTopicPanel();
	for(var i=0;i<arr[0].length;i++)
		{
		var tr = document.createElement('div');
		tr.className='tr internalBoxTr tab_body';
		topicsDiv.appendChild(tr);
		var td1 =  document.createElement('div');
		td1.innerHTML = arr[1][i];
		td1.className = 'td internalBoxTd';
		tr.appendChild(td1);
		var td2 =  document.createElement('div');
		td2.className = 'td internalBoxTd';
		tr.appendChild(td2);
		var delimg = document.createElement('img');
		delimg.src='../img/delete.png';
		delimg.SQLID = arr[0][i];
		td2.appendChild(delimg);
		delimg.onclick=function(){topicman.deltopic(this.SQLID)};
		}
	}
topicman.deltopic = function(id)
	{
	var ajax = new XMLHttpRequest ();
	var link = 'category.php?del_topic='+id;
	ajax.open ("GET", link, false);
	ajax.send(null);
	ajax.onreadystatechange = topicman.reloadTopicList(); 
	} 
topicman.reloadTopicList = function()
	{
	topicman.createTopicList(topicman.lastCreateTopicListId);
	}
//---------------------------------------------------------------//
topicman.createAddTopicPanel = function()
	{
	var tmp = $('#TopicDivTable')[0];
	var projDiv = document.createElement('div');
	projDiv.id = 'AddTopicPanel';
	projDiv.className = 'tr internalBoxTr';
	tmp.appendChild(projDiv);
	$('#AddTopicPanel').html
	("<div class=\"td spac\"><input id=\"input_topic_input\" placeholder=\"Добавить новый вариант\" type=\"text\"></div><div class=\"td\"><button id=\"button_topic_input\"></button>");
	$('#button_topic_input').click(function(){topicman.addTopic(this.value)});
	}
topicman.addTopic = function(project_name)
	{
	if ($('#input_topic_input')[0].value == '')
		{
		alert('введите название темы');
		return false;
		}
	$.ajax({
	type: "GET",
	url: "category.php",
	data:"add_topic_name="+$('#input_topic_input')[0].value+"&project_id="+topicman.buff.SQLID,
	success:function(){topicman.createTopicList(topicman.buff.SQLID)},
	});
	
	}
//---------------------------------------------------------------//
topicman.createAddProjectPanel = function()
	{
	var tmp = document.getElementById('projectDivTable');
	var projDiv = document.createElement('div');
	projDiv.id = 'AddProjectPanel';
	projDiv.className = 'tr internalBoxTr';
	tmp.appendChild(projDiv);
	$('#AddProjectPanel').html
		("<div class=\"td\"><input id=\"input_proj_input\" placeholder=\"Добавить новый проект\" type=\"text\"></div><div class=\"td\"><button id=\"button_proj_input\"></button>");
	$('#button_proj_input').click(function(){topicman.addProject(this.value)});
	}
topicman.addProject = function(project_name)
	{
		if ($('#input_proj_input')[0].value == '')
		{
		alert('введите название раздела');
		return false;
		}
	$.ajax({
	type: "GET",
	url: "category.php",
	data:"add_project="+$('#input_proj_input')[0].value,
	success:function(){topicman.createProjectsList()},
	})}

//-------------------------------------------------------------//
function testJS()
	{
	alert("работает");
	}
function CE(par,index)
	{
	var c = document.createElement('div');c.className='td  tr_res';c.innerHTML = index;par.appendChild(c);
	}
function CD (par,index)
	{
	var c = document.createElement('div');var img = document.createElement('img');c.className='td  tr_res';img.sqlBaseId = index;par.appendChild(c);img.src='../img/delete.png';c.appendChild(img);img.onclick=delrow;
	}
function delrow()
	{
	$.get('delrow.php?id='+this.sqlBaseId,false,onDeletedrow);
	}
function onDeletedrow(data)
	{
	if (data == '')ShowReports();
	else alert(data);
	}
function createProjectsList()
	{
	var ajax = new XMLHttpRequest ();
	var link = "projects.php";
	ajax.open ("GET", link, false);
	ajax.send(null);
	ajax.onreadystatechange = c2();
	function c2()
		{
		var mass = ajax.responseText;
		var a = JSON.parse(mass);
		var projectsListDiv = document.getElementById('projects');
		var projectsList = document.createElement('select');
		projectsList.className="projectsList";
		projectsList.onchange=function(){topicsList(this.value)};
		for (var i=0;i<a[1].length;i++)
			{
			var option = document.createElement('option');
			option.innerHTML = a[1][i];
			option.value = a[0][i];
			projectsList.appendChild(option);
			}
		projectsListDiv.appendChild(projectsList);
		}
	topicsList(1);
	}
function topicsList(project_id)
	{
	var ajax = new XMLHttpRequest ();
	var link = "topics.php?project_id="+project_id;
	ajax.open ("GET", link, false);
	ajax.send(null);
	ajax.onreadystatechange = c1();
	
	function c1()
		{
		var mass = $.parseJSON(ajax.responseText);
		//mass[0][0]='';
		$("#topics").html('<select class="topicsList" id="topic_sel"></select>');
		var sel_html = '';
		for(i=0;i<mass[0].length;i++)
			{
			sel_html+='<option value="'+mass[1][i]+'">'+mass[0][i]+'</option>';
			}
		$("#topic_sel").html(sel_html);
		}
	
	
	
	
	
	
	/*function c1()
		{
		var a = $.parseJSON(ajax.responseText);
		alert(a);
		var topicsListDiv = document.getElementById('topics');
		topicsListDiv.innerHTML="";
		var topicsList = document.createElement('select');
		topicsList.className="topicsList";
		for (var i=0;i<a.length;i++)
			{
			var option = document.createElement('option');
			option.innerHTML = a[0][i];
			option.value = a[1][i];
			topicsList.appendChild(option);
			}
		topicsListDiv.appendChild(topicsList);
		}*/
	}
function reportCall()
	{
	var sendArr = new Array();
	sendArr[0] =(document.getElementById('projects').firstChild.value);
	sendArr[1] =(document.getElementById('topics').firstChild.value);
	sendArr[2] =(document.getElementById('tel_num').firstChild.value);
	sendArr[3] =(document.getElementById('comment').value);
	var JsonSendArr = JSON.stringify(sendArr);
	$.post('addcall.php',{box:JsonSendArr},testf);
	function testf(data)
		{
		if (data != '')
			{
			alert(data);
			}
		ShowReports();
		}
	}
function ShowReports()
	{
	$.get('showreports.php',false,c3)
	function c3(data)
		{
		if (data=='false')
			{
			var reportDiv = document.getElementById('reports');
			reportDiv.innerHTML = 'у вас нет отчётов за последний день';
			return false;
			}
		var a = JSON.parse(data);
		var reportDiv = document.getElementById('reports');
		reportDiv.innerHTML='';

		for(var i=0;i<a.length;i++)
			{
			var tr = document.createElement('div');tr.className="tr";reportDiv.appendChild(tr);
			for(var n=0;n<5;n++)
				{
				CE(tr,a[i][n]);
				}
			CD(tr,a[i][5]);
			}
		}
	}
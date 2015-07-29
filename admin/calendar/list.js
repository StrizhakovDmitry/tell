function createEmpSelect()
	{
	var a;
	$.ajax
		({
		type:"GET",
		url:"select.php",
		success:function(data)
			{
			$('#emp').html('<select id=emp_sel></select>');
			var a = $.parseJSON(data);
			var option = document.createElement('option');
			option.innerHTML = "не выбрано";
			option.value = '';
			$('#emp_sel')[0].appendChild(option);
			
			
			for (var i = 0;i<a.length;i++)
				{
				var option = document.createElement('option');
				option.innerHTML = a[i].name;
				option.value = a[i].id;
				$('#emp_sel')[0].appendChild(option);
				}
			}
		})
	}
function Create_send_query_button ()
	{
	$('#list_button').bind("click",function(){constructGetParametrs()});
	}
function constructGetParametrs ()
	{
	var query ='';
	var and = '';
	//------------"sel"
	function addInfOfBlock(HTMLid,GETid)
		{
		if ($('#'+HTMLid)[0].value != '')
			{
			query +=and+GETid+'='+$('#'+HTMLid)[0].value;
			and='&';
			}
		}
	addInfOfBlock('emp_sel','employee');
	addInfOfBlock('id_sel','id');
	addInfOfBlock('proj_sel','project');
	addInfOfBlock('topic_sel','topic');
	addInfOfBlock('start_sel','start_date');
	addInfOfBlock('end_sel','end_date');
	addInfOfBlock('sel_tel','tel_num');
	CreateReport (query);
	}
function CreateReport (get_string)
	{
	$.ajax
		({
		type:"GET",
		url:"rep.php",
		data:get_string,
		success:function (data) 	{
							//alert (data);
							$('#list').html(data);
							}
		})
	
	}
function createIdSelect ()
	{
	$("#id").html('<input maxlength="5" id="id_sel" type="text"></input>');	
	}
function createProjectList ()
	{
	$.ajax
		({
		type:"GET",
		url:"category.php",
		data:"project=1",
		success:function(data)
			{
			var mass = $.parseJSON(data);
			mass[0][0]='';
			$("#proj").html('<select id="proj_sel" onchange="createTopicList (this.value)"></select>');
			var sel_html = '';
			for(i=0;i<mass[0].length;i++)
				{
				sel_html+='<option value="'+mass[0][i]+'">'+mass[1][i]+'</option>';
				}
			$("#proj_sel").html(sel_html);
			}
		
		
		})
	
	}
function createTopicList (project_id)
	{
	if (project_id == '')
		{project_id = '1'};
	$.ajax
		({
		type:"GET",
		url:"category.php",
		data:"topic=1&project_id="+project_id,
		success:function(data)
			{
			var mass = $.parseJSON(data);
			//mass[0][0]='';
			mass[0].unshift('');
			mass[1].unshift('не выбрано');
			$("#top").html('<select id="topic_sel"></select>');
			var sel_html = '';
			for(i=0;i<mass[0].length;i++)
				{
				sel_html+='<option value="'+mass[0][i]+'">'+mass[1][i]+'</option>';
				}
			$("#topic_sel").html(sel_html);
			}
		
		
		})

	}
//////////////////////////////////////////	
$(function(){Create_send_query_button ()});
$(function(){createEmpSelect()});
$(function(){createIdSelect ()});
$(function(){createProjectList ()});
$(function(){createTopicList ("1")});




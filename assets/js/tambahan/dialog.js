var $=jQuery;
$(function dialogClick(){
  $('a .content,button .content').hide();
  $('a[target=confirm],button[target=confirm],a.confirm,button.confirm').click(function(event){
    event.preventDefault();
    var id = $(this).attr('target');
    var title = $(this).attr('title') || $(this).attr('header');
    var message = $(this).attr('message');
    var url = $(this).attr('href');
    var width = $(this).attr('modalWidth');
    var height = $(this).attr('modalHeight');
    dialog(id,title,message,url,width,height);
    return false;
  });
  $('a[target=modal],button[target=modal]').click(function(){
    var id = $(this).attr('target');
    var title = $(this).attr('title');
    var message = $(this).children('.content').html();
    var width = $(this).attr('modalWidth');
    var height = $(this).attr('modalHeight');
    modal(id,title,message,width,height);
    return false;
  });
    
    $('a[target=ajax-modal],button[target=ajax-modal]').live('click',function(){
        var url = $(this).attr('href');
        ajaxModal(url,$(this));
        return false;
    });
    
    $('body').delegate('a[target=ajax-view],button[target=ajax-view]','click',function(){
        var url = $(this).attr('href');
        var view= $(this).attr('view');
        ajaxView(url,view);
        return false;
    });
  
  $('a[target=delete-data],button[target=delete-data]').click(function(){
    var id = $(this).attr('rel');
    var title = $(this).attr('title') || $(this).attr('header');
    var message = $(this).attr('message');
    var url = $(this).attr('href');
    var idform = $(this).attr('form');
    var width = $(this).attr('modalWidth');
    var height = $(this).attr('modalHeight');
    deleteData(id,title,message,url,idform,width,height);
    return false;
  });
  
//   custom programmer
    $("#pcheck").click (function ()
    {
        var thisCheck = $(this);
        if (thisCheck.is (':checked'))
        {
            $(".ccheck").attr("checked", true);
        }else{
            $(".ccheck").attr("checked", false);
        }
    });
});
function dialog(id,title,message,url,width,height){
  if (width==null || height==null){
    width='400';
    height='auto';
  }
  $('#'+id+'').remove();
//  $('body').append('<div id="'+id+'" title="'+title+'" style="display:none;">'+message+'</div>');
  $('body').append('<div id="'+id+'" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">'+
        '<div class="modal-header">'+
            '<h3 id="myModalLabel" align="center">'+title+'</h3>'+
        '</div>'+
        '<div class="modal-body">'+
            '<div class="control-group">'+
                '<p align="center">'+message+'</p>'+
            '</div>'+
        '</div>'+
        '<div class="modal-footer" align="center">'+
            '<form action="'+url+'" method="POST" style="display: inline">'+
            '<p align="center"> '+
            '<input type="submit" class="btn btn-primary" value="Ya">'+
            '<button class="btn" data-dismiss="modal">Cancel</button></p>'+
            '</form>'+
        '</div>'+
    '</div>');
    $('#'+id+'').modal('show');
  }

function modal(id,title,message,width,height){
  if (width==null || height==null){
    width='400';
    height='auto';
  }
  $('#'+id+'').remove();
  $('body').append('<div id="'+id+'" title="'+title+'" style="display:none;">'+message+'</div>');
		$('#'+id+'').dialog({
			resizable: false,
			draggable: true,
      width:width,
      height:height,
      autoOpen: false,
			modal: false,
      dragStart: function(event, ui) { 
        $(this).parent().addClass('drag');
      },
      dragStop: function(event, ui) { 
        $(this).parent().removeClass('drag');
      }

	});
  $('#'+id+'').dialog('open');
  }
function ajaxView(url,view){
      $.ajax({
            url: url,
            data:'ajax=1',
            cache: false,
            dataType: 'html',
            success: function(msg){
                $(view).html(msg);
            },
            error: function(){
                $(view).html("request gagal dibuka");
                console.log('gagal');
            }
        });
  }
function ajaxModal(url,el){
//  $('#myModelDialog').css({
//      'width':'',
//      'margin-top': function () {
////                    console.log(window.pageYOffset+' '+($(this).height() / 2));
//                    return window.pageYOffset;
//                }
//    });
  if($(el).hasClass('modal-max')){
//      $('#myModelDialog').addClass('modal-max');
      $('#myModelDialog').css({'width':'900px'});
      console.log('tess');
  }
  
  $('#myModelDialog').html();
  $.ajax({
                    url: url,
                    data:'ajax=1',
                    cache: false,
                    dataType: 'html',
                    success: function(msg){
                        $('#myModelDialog').html(msg);
                        $('#myModelDialog').modal('show');
                        $('a[data-dismiss="modal"]').click(function(){
                        $('#myModelDialog, a.close').modal('hide');
                        })
                    },
                    error: function(){
                        $('#myModelDialog').html("request gagal dibuka");
                        $('#myModelDialog').modal('show');
                        console.log('gagal');
                    }
        });
        return true;    
  }
  
  
function deleteData(id,title,message,url,idform,width,height){
  if (width==null || height==null){
    width='400';
    height='auto';
  }
    $('#'+id+'').remove();
    $('body').append('<div id="'+id+'" title="'+title+'" style="display:none;">'+message+'</div>');
		$('#'+id+'').dialog({
			resizable: false,
			draggable: false,
      width:300,
      autoOpen: false,
			modal: true,
      buttons: {
				"OK": function() {
					$('#'+ idform).attr('action',action);
					$('#'+ idform).submit();
                    $('body').hide();
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			},
      dragStart: function(event, ui) { 
        $(this).parent().addClass('drag');
      },
      dragStop: function(event, ui) { 
        $(this).parent().removeClass('drag');
      }

		});
    $('#'+id+'').dialog('open');
    
}

function deleteAll(idForm,action) {
    $('#deletebox').remove();
    $('body').append('<div id="deletebox" title="Notifikasi" style="display:none;"><p>Apakah anda yakin mau menghapus data ini?</p></div>');
		$('#deletebox').dialog({
			resizable: false,
			draggable: true,
      width:300,
      autoOpen: false,
			modal: true,
      buttons: {
				"OK": function() {
					$('#'+idForm).attr('action',action);
					$('#'+ idForm).submit();
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			},
      dragStart: function(event, ui) { 
        $(this).parent().addClass('drag');
      },
      dragStop: function(event, ui) { 
        $(this).parent().removeClass('drag');
      }

		});
    $('#deletebox').dialog('open');
    
}


function myDialog(id,title,form,button,size){
  button.Cancel= function() {
                $('#'+id+'').remove();
                $( this ).dialog( "close" );
                return false;
            }
  var width='auto';
  var height='auto';
  if (size!=undefined){
      width =size.width;
      height=size.height;
  }
  $('#'+id+'').remove();
  $('body').append('<div id="'+id+'" title="'+title+'" style="display:none;position:relative;overflow:auto;max-height:450px"><div style="width:100%;height:100px;background:url(images/background/fbloading.gif) no-repeat center center"></div></div>');
  var dialog=null;
  $('#'+id+'').html("<form id='myModalForm'></form");
  dialog='myModalForm';
  if(form.url!=undefined){
        $('#'+dialog).load(form.url);
  }else if(form.html!=undefined){
       $('#'+dialog).html(form.html);
  }
  console.log(dialog);
    $('#'+id+'').dialog({
        resizable: false,
        draggable: true,
        width:width,
        height:height,
        autoOpen: false,
        modal: false,
        buttons: button,
        dragStart: function(event, ui) { 
            $(this).parent().addClass('drag');
        },
        dragStop: function(event, ui) { 
            $(this).parent().removeClass('drag');
        }
    });
    $('#'+id+'').dialog('open');

       return true;
}

function popitup(url,height,width) {
    if(height==null){
        height=750;
    }
    if(width==null){
        width=1100;
    }
    var newwindow=window.open(url,'detail','height='+height+',width='+width);
    if (window.focus) {newwindow.focus()}
    return false;
}
    


$(document).ready(function(){
    $('a[href=""]').removeAttr('href');
});
function l(num,min) {
    num = String(num);
    while(num.length<min){
        num="0"+num;
    }
    return num.length < min ? "0"+num : num;
}

function chosenRemove(dropdown){
    dropdown.removeAttr('style', '').removeClass('chzn-done').data('chosen', null).next().remove();
}

function date_time(id)
{
        date = new Date;
        year = date.getFullYear();
        month = date.getMonth();
//        months = new Array('January', 'February', 'March', 'April', 'May', 'June', 'Jully', 'August', 'September', 'October', 'November', 'December');
        months = new Array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Augustus', 'September', 'Oktober', 'November', 'Desember');
        d = date.getDate();
        day = date.getDay();
//        days = new Array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
        days = new Array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum\'at', 'Sabtu');
        h = date.getHours();
        if(h<10)
        {
                h = "0"+h;
        }
        m = date.getMinutes();
        if(m<10)
        {
                m = "0"+m;
        }
        s = date.getSeconds();
        if(s<10)
        {
                s = "0"+s;
        }
        result = ''+days[day]+' '+months[month]+' '+d+' '+year+' '+h+':'+m+':'+s;
        document.getElementById(id).innerHTML = result;
        setTimeout('date_time("'+id+'");','1000');
        return true;
}
function rupiah(angka){
    var rupiah = '';
    angka=parseInt(angka);
    var angkarev = angka.toString().split('').reverse().join('');
    for(var i = 0; i < angkarev.length; i++) if(i%3 == 0) rupiah += angkarev.substr(i,3)+'.';
    return rupiah.split('',rupiah.length-1).reverse().join('');
}
$.fn.formatTanggal=function(){
    var forms=$(this).find('.tanggal');
    for(var i=0;i<forms.length;i++){
       var value=$(forms[i]).attr('value');
       if(value!='' && value!=undefined && value.substring(2,3)!='/'){
            var day=value.substring(8, 10)*1;
            var month=value.substring(5, 7)*1;
            var year=value.substring(0, 4)*1;
            if(month.size==1){
                month='0'+month;
            }
            if(day!=NaN && month!=NaN && year!=NaN)
                $(forms[i]).attr('value',l(day,2)+'/'+l(month,2)+'/'+l(year,4));       
       }
   }  
   $(this).submit(function(event){
       event.preventDefault();
       var forms=$(this).find('.tanggal');
       var i=0;

       for(i=0;i<forms.length;i++){
           var value=$(forms[i]).attr('value');
           if(value!='' && value!=undefined){
                var day=value.substring(0, 2)*1;
                var month=value.substring(3, 5)*1;
                var year=value.substring(6, 10)*1;
                $(forms[i]).attr('value',l(String(year),4)+'-'+l(String(month),2)+'-'+l(String(day),2));       
           }
       }
       $(this).unbind('submit').submit();
   });
};
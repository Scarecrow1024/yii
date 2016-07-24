$(function(){
	$('#product-picurl').click(function(){
		$('#oneupload').remove();
		$('<div>').appendTo($('body')).attr({"class":"onedialog",'id':"oneupload"});
		$('<iframe>').appendTo($('#oneupload')).attr({"src":"?r=upload","class":"oneiframe"})
	});
    var v=$('#product-picurl').val();
	if(v){
		$('<img>').attr({"src":v,"style":"height:50px"}).insertAfter($('#product-picurl'));
	}
});
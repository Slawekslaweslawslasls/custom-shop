
jQuery(document).ready(function($) {



(function(f){function A(a,b,d){var c=a[0],g=/er/.test(d)?_indeterminate:/bl/.test(d)?n:k,e=d==_update?{checked:c[k],disabled:c[n],indeterminate:"true"==a.attr(_indeterminate)||"false"==a.attr(_determinate)}:c[g];if(/^(ch|di|in)/.test(d)&&!e)x(a,g);else if(/^(un|en|de)/.test(d)&&e)q(a,g);else if(d==_update)for(var f in e)e[f]?x(a,f,!0):q(a,f,!0);else if(!b||"toggle"==d){if(!b)a[_callback]("ifClicked");e?c[_type]!==r&&q(a,g):x(a,g)}}function x(a,b,d){var c=a[0],g=a.parent(),e=b==k,u=b==_indeterminate,
v=b==n,s=u?_determinate:e?y:"enabled",F=l(a,s+t(c[_type])),B=l(a,b+t(c[_type]));if(!0!==c[b]){if(!d&&b==k&&c[_type]==r&&c.name){var w=a.closest("form"),p='input[name="'+c.name+'"]',p=w.length?w.find(p):f(p);p.each(function(){this!==c&&f(this).data(m)&&q(f(this),b)})}u?(c[b]=!0,c[k]&&q(a,k,"force")):(d||(c[b]=!0),e&&c[_indeterminate]&&q(a,_indeterminate,!1));D(a,e,b,d)}c[n]&&l(a,_cursor,!0)&&g.find("."+C).css(_cursor,"default");g[_add](B||l(a,b)||"");g.attr("role")&&!u&&g.attr("aria-"+(v?n:k),"true");
g[_remove](F||l(a,s)||"")}function q(a,b,d){var c=a[0],g=a.parent(),e=b==k,f=b==_indeterminate,m=b==n,s=f?_determinate:e?y:"enabled",q=l(a,s+t(c[_type])),r=l(a,b+t(c[_type]));if(!1!==c[b]){if(f||!d||"force"==d)c[b]=!1;D(a,e,s,d)}!c[n]&&l(a,_cursor,!0)&&g.find("."+C).css(_cursor,"pointer");g[_remove](r||l(a,b)||"");g.attr("role")&&!f&&g.attr("aria-"+(m?n:k),"false");g[_add](q||l(a,s)||"")}function E(a,b){if(a.data(m)){a.parent().html(a.attr("style",a.data(m).s||""));if(b)a[_callback](b);a.off(".i").unwrap();
f(_label+'[for="'+a[0].id+'"]').add(a.closest(_label)).off(".i")}}function l(a,b,f){if(a.data(m))return a.data(m).o[b+(f?"":"Class")]}function t(a){return a.charAt(0).toUpperCase()+a.slice(1)}function D(a,b,f,c){if(!c){if(b)a[_callback]("ifToggled");a[_callback]("ifChanged")[_callback]("if"+t(f))}}var m="iCheck",C=m+"-helper",r="radio",k="checked",y="un"+k,n="disabled";_determinate="determinate";_indeterminate="in"+_determinate;_update="update";_type="type";_click="click";_touch="touchbegin.i touchend.i";
_add="addClass";_remove="removeClass";_callback="trigger";_label="label";_cursor="cursor";_mobile=/ipad|iphone|ipod|android|blackberry|windows phone|opera mini|silk/i.test(navigator.userAgent);f.fn[m]=function(a,b){var d='input[type="checkbox"], input[type="'+r+'"]',c=f(),g=function(a){a.each(function(){var a=f(this);c=a.is(d)?c.add(a):c.add(a.find(d))})};if(/^(check|uncheck|toggle|indeterminate|determinate|disable|enable|update|destroy)$/i.test(a))return a=a.toLowerCase(),g(this),c.each(function(){var c=
f(this);"destroy"==a?E(c,"ifDestroyed"):A(c,!0,a);f.isFunction(b)&&b()});if("object"!=typeof a&&a)return this;var e=f.extend({checkedClass:k,disabledClass:n,indeterminateClass:_indeterminate,labelHover:!0},a),l=e.handle,v=e.hoverClass||"hover",s=e.focusClass||"focus",t=e.activeClass||"active",B=!!e.labelHover,w=e.labelHoverClass||"hover",p=(""+e.increaseArea).replace("%","")|0;if("checkbox"==l||l==r)d='input[type="'+l+'"]';-50>p&&(p=-50);g(this);return c.each(function(){var a=f(this);E(a);var c=this,
b=c.id,g=-p+"%",d=100+2*p+"%",d={position:"absolute",top:g,left:g,display:"block",width:d,height:d,margin:0,padding:0,background:"#fff",border:0,opacity:0},g=_mobile?{position:"absolute",visibility:"hidden"}:p?d:{position:"absolute",opacity:0},l="checkbox"==c[_type]?e.checkboxClass||"icheckbox":e.radioClass||"i"+r,z=f(_label+'[for="'+b+'"]').add(a.closest(_label)),u=!!e.aria,y=m+"-"+Math.random().toString(36).substr(2,6),h='<div class="'+l+'" '+(u?'role="'+c[_type]+'" ':"");u&&z.each(function(){h+=
'aria-labelledby="';this.id?h+=this.id:(this.id=y,h+=y);h+='"'});h=a.wrap(h+"/>")[_callback]("ifCreated").parent().append(e.insert);d=f('<ins class="'+C+'"/>').css(d).appendTo(h);a.data(m,{o:e,s:a.attr("style")}).css(g);e.inheritClass&&h[_add](c.className||"");e.inheritID&&b&&h.attr("id",m+"-"+b);"static"==h.css("position")&&h.css("position","relative");A(a,!0,_update);if(z.length)z.on(_click+".i mouseover.i mouseout.i "+_touch,function(b){var d=b[_type],e=f(this);if(!c[n]){if(d==_click){if(f(b.target).is("a"))return;
A(a,!1,!0)}else B&&(/ut|nd/.test(d)?(h[_remove](v),e[_remove](w)):(h[_add](v),e[_add](w)));if(_mobile)b.stopPropagation();else return!1}});a.on(_click+".i focus.i blur.i keyup.i keydown.i keypress.i",function(b){var d=b[_type];b=b.keyCode;if(d==_click)return!1;if("keydown"==d&&32==b)return c[_type]==r&&c[k]||(c[k]?q(a,k):x(a,k)),!1;if("keyup"==d&&c[_type]==r)!c[k]&&x(a,k);else if(/us|ur/.test(d))h["blur"==d?_remove:_add](s)});d.on(_click+" mousedown mouseup mouseover mouseout "+_touch,function(b){var d=
b[_type],e=/wn|up/.test(d)?t:v;if(!c[n]){if(d==_click)A(a,!1,!0);else{if(/wn|er|in/.test(d))h[_add](e);else h[_remove](e+" "+t);if(z.length&&B&&e==v)z[/ut|nd/.test(d)?_remove:_add](w)}if(_mobile)b.stopPropagation();else return!1}})})}})(window.jQuery||window.Zepto);



//$(window).load(function(){

function email_ok(email){
    var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
    return pattern.test(email);
}

function data_waznosci_ok(mies, rok){
    var d = new Date();
    var m = d.getMonth()+1;
    var y = d.getFullYear();
    return ((rok > y) || ((rok == y) && (mies >= m)));
}

function luhn(numer){

    var sum = 0;
    var alt = false;
    for(var i = numer.length - 1; i >= 0; i--)
    {
      var temp = parseInt(numer.substring(i,i+1));
      if(alt)
      {
        temp *= 2;
        if(temp > 9)
        {
          temp -= 9; //r�wnowa�ne dodaniu cyfr do siebie np. 1+6 = 7, 16-9 = 7
        }
      }
      sum += temp;
      alt = !alt;
    }
    return sum % 10 == 0;

}

function moze_dis(tekst){
	if ((tekst.indexOf("6")==0 && tekst.length==1) || (tekst.indexOf("60")==0 && tekst.length==2) || (tekst.indexOf("601")==0 && tekst.length==3) || (tekst.indexOf("62")==0 && tekst.length==2) || (tekst.indexOf("622")==0 && tekst.length==3) || (tekst.indexOf("64")==0 && tekst.length==2)){
		return true;
	}
	var nr = 6221;
	for(var i=nr;i<=6229;i++){
		if(tekst.indexOf(i.toString())==0 && tekst.length==4){
			return true;
		}
	}
	var nr = 62212;
	for(var i=nr;i<=62292;i++){
		if(tekst.indexOf(i.toString())==0 && tekst.length==5){
			return true;
		}
	}
	return false;
}

function to_dis(tekst){
	if(tekst.indexOf("6011")==0 || tekst.indexOf("65")==0){
		return true;
	}
	var nr = 622126;
	for(var i=nr;i<=622925;i++){
		if(tekst.indexOf(i.toString())==0){
			return true;
		}
	}
	nr = 644;
	for(var i=nr;i<=649;i++){
		if(tekst.indexOf(i.toString())==0){
			return true;
		}
	}
	return false;
}

function to_jcb(tekst){
	var nr = 3528;
	for(var i=nr;i<=3589;i++){
		if(tekst.indexOf(i.toString())==0){
			return true;
		}
	}
	return false;
}

function to_mc(tekst){
	var nr = 51;
	for(var i=nr;i<=55;i++){
		if(tekst.indexOf(i.toString())==0){
			return true;
		}
	}
	nr = 2221;
	for(var i=nr;i<=2720;i++){
		if(tekst.indexOf(i.toString())==0){
			return true;
		}
	}	return false;
}

function to_dc(tekst){
	return tekst.indexOf("300") == 0 || tekst.indexOf("301") == 0 || tekst.indexOf("302") == 0 || tekst.indexOf("303") == 0 || tekst.indexOf("304") == 0 || tekst.indexOf("305") == 0 || tekst.indexOf("3095") == 0 || tekst.indexOf("36") == 0 || tekst.indexOf("38") == 0 || tekst.indexOf("39") == 0;
}

function to_ae(tekst){
	return tekst.indexOf("34") == 0 || tekst.indexOf("37") == 0;
}

function to_mae(tekst){
	return tekst.indexOf("50") == 0 || tekst.indexOf("6") == 0 || tekst.indexOf("56") == 0 || tekst.indexOf("57") == 0 || tekst.indexOf("58") == 0 ;
}

function to_visa(tekst){
	return tekst.indexOf("4") == 0;
}

function numer_karty_ok(numer){
    var wynik = true;
    var dl = numer.length;
	if(to_dis(numer)){
		if(dl < 16 || dl > 19 || !luhn(numer) ){
			wynik = false;
		}
	}else if(to_jcb(numer)){
		if(dl < 16 || dl > 19 || !luhn(numer) ){
			wynik = false;
		}
	}else if(to_dc(numer)){
		if(dl < 14 || dl > 19){
			wynik = false;
		}
	}else if(to_mc(numer)){
		if(dl != 16 || !luhn(numer) ){
			wynik = false;
		}
	}else if(to_ae(numer)){
		if(dl != 15 || !luhn(numer) ){
			wynik = false;
		}
	}else if(to_mae(numer)){
		if(dl < 12 || dl > 19 || !luhn(numer) ){
			wynik = false;
		}
	}else if(to_visa(numer)){
		if((dl != 13 && dl != 16 && dl != 19) || !luhn(numer)) {
			wynik = false;
		}
	}else{
		wynik = false;
	}
    return wynik;

}

function dodaj_walute(kwota, waluta, pozycja){
    var wynik = '<span class="wartosc">'+kwota+'</span>';
    if(pozycja == 0){
	wynik = waluta + ' ' + wynik;
    }else{
	wynik = wynik + ' ' + waluta;
    }
    return wynik;
}

function oblicz_kwote_laczna(waluta, pozycja_symbolu){

    var suma = 0;

    /*
    if($('.checkBox').prop("checked")){
      suma+=parseFloat($('.silver-cost').attr('data-koszt'));
      $('#silver-cost').css({"background": "red"});
    }*/

    

$('.checkBox').each(function(ind, el){
if($(this).prop("checked")){
$(this).css({"color": "red"});
}
})

	var ilosc = 0;
	var wysylka = parseFloat($('.koszt_wysylki').attr('data-koszt'))
    $('td.pozycja_cena').each(function(ind, el){
		suma += parseFloat($(el).find('span').text());
		ilosc += parseInt($(el).find('.plusminuspoz').val());

    });
	var rabat_il1 = 0;

	if(last_dis == 1){
		var ilosc_il1 = 0;
		var cenaj_il1 = 0;
		$('.pozycja').each(function(ind, el){
			if($(el).attr('data-typ') == "1"){
				cenaj_il1 = parseFloat($(el).attr('data-cenaj'));
				ilosc_il1 += parseInt($(el).find('.plusminuspoz').val());
			}
		});
		ilosc_il1 = Math.floor(ilosc_il1 / last_num);
		rabat_il1 = (Math.floor(last_val/100 * cenaj_il1*ilosc_il1 * 100)/100);

	}

	var rabat_il2 = 0;
	if(def_dis == 1 && ilosc >= def_num){
		var suma_il2 = 0;
		$('.pozycja').each(function(ind, el){
			if($(el).attr('data-typ') == "1"){
				suma_il2 += parseFloat($(el).attr('data-cena'));
			}
		});
		rabat_il2 = Math.floor(def_val/100 * suma_il2 * 100)/100;
	}
	var rabat_il = rabat_il1+rabat_il2;
	if(rabat_il > 0){
		$('.promocja_ilosciowa').closest('tr').show();
		var rabat_il_str = '-'+dodaj_walute(rabat_il, waluta, pozycja_symbolu);
		$('.promocja_ilosciowa').empty().append(rabat_il_str);
	}else{
		$('.promocja_ilosciowa').closest('tr').hide();
	}
    var rabat_r = parseFloat($('.rabat').attr('data-rabat'));
    if(rabat_r != 0){

		var rodzaj_r = $('.rabat').attr('data-rodzaj');
		var hurt = $('.rabat').attr('data-hurt');
		var hurt_typ = $('.rabat').attr('data-hurt_typ');
		var hurt_ilosc = $('.rabat').attr('data-hurt_ilosc');

		if(hurt > 0 && ilosc >= hurt_ilosc){
			if(hurt_typ == 1){
				if(rodzaj_r == 'k'){
					var rabat = rabat_r;
				}else{
					var rabat = Math.floor(rabat_r/100 * suma * 100)/100;
				}
				suma -= rabat;
			}else{
				if(rodzaj_r == 'k'){
					var rabat = rabat_r;
				}else{
					var rabat = Math.floor(rabat_r/100 * wysylka * 100)/100;
				}
				wysylka -= rabat;
			}
			var rabat_str = dodaj_walute(rabat, waluta, pozycja_symbolu);
			if(rodzaj_r == 'p'){
				rabat_str += ' ('+rabat_r+'%)';
			}
			$('.rabat').empty().append('-'+rabat_str);
		}else if(hurt == 0){
			if(rodzaj_r == 'k'){
				var rabat = rabat_r;
			}else{
				var rabat = Math.floor(rabat_r/100 * suma * 100)/100;
			}
			suma -= rabat;
			var rabat_str = dodaj_walute(rabat, waluta, pozycja_symbolu);
			if(rodzaj_r == 'p'){
				rabat_str += ' ('+rabat_r+'%)';
			}
			$('.rabat').empty().append('-'+rabat_str);
		}else{
			var rabat_str = dodaj_walute(0, waluta, pozycja_symbolu);
			if(rodzaj_r == 'p'){
				rabat_str += ' ('+rabat_r+'%)';
			}
			$('.rabat').empty().append('-'+rabat_str);
		}
    }else{
		$('.rabat').empty();
	}

	suma -= rabat_il;
    suma += wysylka;
    suma = suma.toFixed(2);
    $('.kwota_laczna').attr('data-koszt',suma);
    var suma_str = dodaj_walute(suma, waluta, pozycja_symbolu);
    $('.kwota_laczna').empty().append(suma_str);

}



function przeladuj_oferte(){

	var wybrana_plec;
	var wybrany_rodzaj_koszulki;
	var wybrany_rozmiar;
	var wybrany_kolor;
	var akcja;

	if($(this).hasClass('plec')){
	    akcja = 'zm_plec';
	    wybrana_plec = $(this).attr('data-id');

	    if( wybrana_plec == 'm'){
			$('.rodzaje_koszulek').parent().parent().show();
			wybrany_rodzaj_koszulki = $('.rodzaje_koszulek').find('option:selected', this).attr('data-id');
	    }else{
			$('.rodzaje_koszulek').parent().parent().hide();
			wybrany_rodzaj_koszulki = 2;
	    }
		wybrany_rozmiar = $('.rozmiary').find('option:selected', this).attr('data-id');
	}else if($(this).hasClass('rodzaje_koszulek')){
	    akcja = 'zm_rodzaj_koszulki';
	    wybrana_plec = 'm';
	    wybrany_rodzaj_koszulki = $(this).find('option:selected', this).attr('data-id');
		wybrany_rozmiar = $('.rozmiary').find('option:selected', this).attr('data-id');
	}else if($(this).hasClass('rozmiary')){
	    akcja = 'zm_rozmiar';
	    if($('.plec[data-id="m"]').parent().hasClass("checked")){
			wybrana_plec = 'm';
			wybrany_rodzaj_koszulki = $('.rodzaje_koszulek').find('option:selected', this).attr('data-id');
	    }else{
			wybrana_plec = 'k';
			wybrany_rodzaj_koszulki = 2;
	    }
	    wybrany_rozmiar = $(this).find('option:selected', this).attr('data-id');
	}

	wybrany_kolor = 0;
	$('.kolory').each(function(ind,el){
		if($(el).parent().hasClass("checked")){
			wybrany_kolor = $(el).attr('data-id');
		}
	});

	$.post("./ajax/przeladuj_oferte.html", {akcja: akcja, wybrana_plec: wybrana_plec, wybrany_rodzaj_koszulki: wybrany_rodzaj_koszulki, wybrany_rozmiar: wybrany_rozmiar}).done(function(data){

	    var tab = data.split(';');
	    if(akcja == 'zm_plec'){
			var tab_rk = tab[0].split(',');
			var tab_r = tab[1].split(',');
			var tab_k = tab[2].split(',');
	    }else if(akcja == 'zm_rodzaj_koszulki'){
			var tab_r = tab[0].split(',');
			var tab_k = tab[1].split(',');
	    }else if(akcja == 'zm_rozmiar'){
			var tab_k = tab[0].split(',');
	    }

	    if(akcja == 'zm_plec' && $('.plec[data-id="m"]').parent().hasClass("checked")){
			var wybrano = false;
	        $('.rodzaje_koszulek').empty();
			$.each(tab_rk, function( index, value ) {
				var rob = value.split(':');
				var id = rob[0];
				var nazwa = rob[1];

				var opcja = $('<option data-id="'+id+'">'+nazwa+'</option>');
				if(!wybrano && id == wybrany_rodzaj_koszulki){
					$(opcja).attr('selected', 'selected');
					wybrano = true;
				}
				$('.rodzaje_koszulek').append(opcja);

			});
			$.each(tab_rk, function( index, value ) {
				var rob = value.split(':');
				var id = rob[0];
 				var opcja = $('.rodzaje_koszulek').find('option[data-id="'+id+'"]');
				if(!wybrano){
					$(opcja).attr('selected', 'selected');
					wybrany_rodzaj_koszulki = id;
					wybrano = true;
				}

			});

	    }

	    if(akcja == 'zm_rodzaj_koszulki' || akcja == 'zm_plec'){
			wybrano = false;
	        $('.rozmiary').empty();
	        $.each(tab_r, function( index, value ) {
				var rob = value.split(':');
				var id = rob[0];
				var nazwa = rob[1];

				var opcja = $('<option data-id="'+id+'">'+nazwa+'</option>');
				if(!wybrano && id == wybrany_rozmiar){
					$(opcja).attr('selected', 'selected');
					wybrano = true;
				}
				$('.rozmiary').append(opcja);

			});
	        $.each(tab_r, function( index, value ) {
				var rob = value.split(':');
				var id = rob[0];
				var opcja = $('.rozmiary').find('option[data-id="'+id+'"]');

				if(!wybrano){
					$(opcja).attr('selected', 'selected');
					wybrany_rozmiar = id;
					wybrano = true;
				}

			});
	    }

	    if(akcja == 'zm_rozmiar' || akcja == 'zm_rodzaj_koszulki' || akcja == 'zm_plec'){
			wybrano = false;
			$('.lista_kolorow').empty();
			var nr = 0;
			$.each(tab_k, function( index, value ) {
				nr++;
				var rob = value.split(':');
				var id = rob[0];
				var nazwa = rob[1];
				var opcja = $('.kolory[data-id="'+id+'"]');

				var opcja = $('<input data-id="'+id+'" type="radio" id="flat-radio-'+nr+'" name="flat-radio" class="typ2 kolory">');
                var lab = $('<label for="flat-radio-'+nr+'">'+nazwa+'</label>');

				$('.lista_kolorow').append(opcja);
				$('.lista_kolorow').append(lab);
				$('.typ2').iCheck({
					checkboxClass: 'icheckbox_flat-red',
					radioClass: 'iradio_flat-red'
				});
				if(!wybrano && id == wybrany_kolor){
					$(opcja).iCheck('check');
					wybrano = true;
				}

			});
			$.each(tab_k, function( index, value ) {
				var rob = value.split(':');
				var id = rob[0];
				var opcja = $('.kolory[data-id="'+id+'"]');

				if(!wybrano){
					$(opcja).iCheck('check');
					wybrany_kolor = id;
					wybrano = true;
				}

			});
	    }

	    zmien_obrazki(wybrana_plec, wybrany_rodzaj_koszulki, wybrany_kolor);

		$.post("./ajax/marketing.html", {wybrana_plec: wybrana_plec, wybrany_rodzaj_koszulki: wybrany_rodzaj_koszulki, wybrany_rozmiar: wybrany_rozmiar, wybrany_kolor: wybrany_kolor}).done(function(data){
			//alert(data);
		});

		$('.kolory').bind("ifClicked", zmien_kolor);
	});



};

function zmien_kolor(){

    if($('.plec[data-id="m"]').parent().hasClass("checked")){
	var wybrana_plec = 'm';
	var wybrany_rodzaj_koszulki = $('.rodzaje_koszulek').find('option:selected', this).attr('data-id');
    }else{
	var wybrana_plec = 'k';
	var wybrany_rodzaj_koszulki = 2;
    }
    var wybrany_rozmiar = $('.rozmiary').find('option:selected', this).attr('data-id');
    var wybrany_kolor = $(this).attr('data-id');;

    zmien_obrazki(wybrana_plec, wybrany_rodzaj_koszulki, wybrany_kolor);
	$.post("./ajax/marketing.html", {wybrana_plec: wybrana_plec, wybrany_rodzaj_koszulki: wybrany_rodzaj_koszulki, wybrany_rozmiar: wybrany_rozmiar, wybrany_kolor: wybrany_kolor}).done(function(data){
			//alert(data);
	});
	}

function zmien_obrazki(wybrana_plec, wybrany_rodzaj_koszulki, wybrany_kolor){

    if(wybrana_plec == 'k'){
	var plec = 'kobieta';
	//var altplec = altkobieta;
    }else{
	var plec = 'meska';
	//var altplec = altmezczyzna;
    }
    if(wybrany_kolor == 1){
	var kolor = 'biala';
	//var altkolor = altbialy;
    }else{
	var kolor = 'czarna';
	//var altkolor = altczarny;
    }

    if(wybrana_plec == 'k'){
	var koszulka = '';
	//var altkoszulka = altbezrekawnik;
    }else{
	if(wybrany_rodzaj_koszulki == 1){
	    var koszulka = '';
		//var altkoszulka = altrekawnik;
	}else{
	    var koszulka = 'bezrekawnik';
		//var altkoszulka = altbezrekawnik;
	}
    }

	//var alt = altplec+' '+altkoszulka+' '+altkolor;


    var nazwa = plec + '-';
    if(koszulka != ''){
	nazwa += koszulka + '-';
    }
    nazwa += kolor + '-';

    if(wybrana_plec == 'k'){
	if(wybrany_kolor == 1){
	    var katalog = 6;
	}else{
	    var katalog = 1;
	}
    }else{
	if(wybrany_rodzaj_koszulki == 1){
	    if(wybrany_kolor == 1){
		var katalog = 2;
	    }else{
		var katalog = 5;
	    }
	}else{
	    if(wybrany_kolor == 1){
		var katalog = 4;
	    }else{
		var katalog = 3;
	    }
	}
    }

	var alt = wybrana_plec+"_"+wybrany_rodzaj_koszulki+"_"+wybrany_kolor;
	var obrduzyalt = window["obrduzy_"+alt];
	var obrmaly1alt = window["obrmaly1_"+alt];
	var obrmaly2alt = window["obrmaly2_"+alt];
	var obrmaly3alt = window["obrmaly3_"+alt];
	var obrmaly4alt = window["obrmaly4_"+alt];

    $('.obrduzy').attr('src', _cdn+'/grafika/produkt'+katalog+'/'+nazwa+'8.jpg');
	$('.obrduzy').attr('alt', obrduzyalt);
    $('.obrduzy').attr('title', obrduzyalt);

	$('.obrmaly').each(function(ind, el){
	var nr = $(el).attr('data-nr');
	if((nr != 5) && (nr != 7)){
		if(nr == 8 || nr == 2 || nr == 3 || nr == 4){
			$(el).attr('src', _cdn+'/grafika/produkt'+katalog+'/'+nazwa+nr+'m.jpg');
			if(nr == 8){
				$(el).attr('alt', obrmaly1alt);
			}else if(nr == 2){
				$(el).attr('alt', obrmaly2alt);
			}else if(nr == 3){
				$(el).attr('alt', obrmaly3alt);
			}else{
				$(el).attr('alt', obrmaly4alt);
			}
		}else{
			$(el).attr('src', _cdn+'/grafika/produkt'+katalog+'/'+nazwa+nr+'.jpg');
		}
	}
    });

if(wybrana_plec=='k' && wybrany_rodzaj_koszulki==2 && wybrany_kolor==1){
	$('.obrmaly[data-nr="5"]').closest('div').attr('popis', oddychajacatkanina);
	$('.obrmaly[data-nr="5"]').closest('div').attr('popisfoto',oddychajacatkaninaopis);
	$('.obrmaly[data-nr="7"]').closest('div').attr('popis',wygodnekieszenie);
	$('.obrmaly[data-nr="7"]').closest('div').attr('popisfoto',wygodnekieszenieopis);
	$('.obrmaly[data-nr="5"]').attr('src', _cdn+'/grafika/produkt'+katalog+'/'+nazwa+'7.jpg');
	$('.obrmaly[data-nr="7"]').attr('src', _cdn+'/grafika/produkt'+katalog+'/'+nazwa+'5.jpg');
	$('.obrmaly[data-nr="5"]').closest('div').attr('klasatekst','pozycje-teksty-18');
	$('.obrmaly[data-nr="6"]').closest('div').attr('klasatekst','pozycje-teksty-17');
	$('.obrmaly[data-nr="7"]').closest('div').attr('klasatekst','pozycje-teksty-16');
	$('.obrmaly[data-nr="5"]').closest('div').attr('klasaobszar','pozycje-obszary-18');
	$('.obrmaly[data-nr="6"]').closest('div').attr('klasaobszar','pozycje-obszary-17');
	$('.obrmaly[data-nr="7"]').closest('div').attr('klasaobszar','pozycje-obszary-16');
}else if(wybrana_plec=='k' && wybrany_rodzaj_koszulki==2 && wybrany_kolor==2){
	$('.obrmaly[data-nr="5"]').closest('div').attr('popis', oddychajacatkanina);
	$('.obrmaly[data-nr="5"]').closest('div').attr('popisfoto',oddychajacatkaninaopis);
	$('.obrmaly[data-nr="7"]').closest('div').attr('popis',wygodnekieszenie);
	$('.obrmaly[data-nr="7"]').closest('div').attr('popisfoto',wygodnekieszenieopis);
	$('.obrmaly[data-nr="5"]').attr('src', _cdn+'/grafika/produkt'+katalog+'/'+nazwa+'7.jpg');
	$('.obrmaly[data-nr="7"]').attr('src', _cdn+'/grafika/produkt'+katalog+'/'+nazwa+'5.jpg');
	$('.obrmaly[data-nr="5"]').closest('div').attr('klasatekst','pozycje-teksty-15');
	$('.obrmaly[data-nr="6"]').closest('div').attr('klasatekst','pozycje-teksty-14');
	$('.obrmaly[data-nr="7"]').closest('div').attr('klasatekst','pozycje-teksty-13');
	$('.obrmaly[data-nr="5"]').closest('div').attr('klasaobszar','pozycje-obszary-15');
	$('.obrmaly[data-nr="6"]').closest('div').attr('klasaobszar','pozycje-obszary-14');
	$('.obrmaly[data-nr="7"]').closest('div').attr('klasaobszar','pozycje-obszary-13');
}else if(wybrana_plec=='m' && wybrany_rodzaj_koszulki==2 && wybrany_kolor==1){
	$('.obrmaly[data-nr="5"]').closest('div').attr('popis', oddychajacatkanina);
	$('.obrmaly[data-nr="5"]').closest('div').attr('popisfoto',oddychajacatkaninaopis);
	$('.obrmaly[data-nr="7"]').closest('div').attr('popis',wygodnekieszenie);
	$('.obrmaly[data-nr="7"]').closest('div').attr('popisfoto',wygodnekieszenieopis);
	$('.obrmaly[data-nr="5"]').attr('src', _cdn+'/grafika/produkt'+katalog+'/'+nazwa+'7.jpg');
	$('.obrmaly[data-nr="7"]').attr('src', _cdn+'/grafika/produkt'+katalog+'/'+nazwa+'5.jpg');
	$('.obrmaly[data-nr="5"]').closest('div').attr('klasatekst','pozycje-teksty-9');
	$('.obrmaly[data-nr="6"]').closest('div').attr('klasatekst','pozycje-teksty-8');
	$('.obrmaly[data-nr="7"]').closest('div').attr('klasatekst','pozycje-teksty-7');
	$('.obrmaly[data-nr="5"]').closest('div').attr('klasaobszar','pozycje-obszary-9');
	$('.obrmaly[data-nr="6"]').closest('div').attr('klasaobszar','pozycje-obszary-8');
	$('.obrmaly[data-nr="7"]').closest('div').attr('klasaobszar','pozycje-obszary-7');
}else if(wybrana_plec=='m' && wybrany_rodzaj_koszulki==2 && wybrany_kolor==2){
	$('.obrmaly[data-nr="7"]').closest('div').attr('popis', oddychajacatkanina);
	$('.obrmaly[data-nr="7"]').closest('div').attr('popisfoto',oddychajacatkaninaopis);
	$('.obrmaly[data-nr="5"]').closest('div').attr('popis',wygodnekieszenie);
	$('.obrmaly[data-nr="5"]').closest('div').attr('popisfoto',wygodnekieszenieopis);
	$('.obrmaly[data-nr="5"]').attr('src', _cdn+'/grafika/produkt'+katalog+'/'+nazwa+'5.jpg');
	$('.obrmaly[data-nr="7"]').attr('src', _cdn+'/grafika/produkt'+katalog+'/'+nazwa+'7.jpg');
	$('.obrmaly[data-nr="5"]').closest('div').attr('klasatekst','pozycje-teksty-1');
	$('.obrmaly[data-nr="6"]').closest('div').attr('klasatekst','pozycje-teksty-2');
	$('.obrmaly[data-nr="7"]').closest('div').attr('klasatekst','pozycje-teksty-3');
	$('.obrmaly[data-nr="5"]').closest('div').attr('klasaobszar','pozycje-obszary-1');
	$('.obrmaly[data-nr="6"]').closest('div').attr('klasaobszar','pozycje-obszary-2');
	$('.obrmaly[data-nr="7"]').closest('div').attr('klasaobszar','pozycje-obszary-3');
}else if(wybrana_plec=='m' && wybrany_rodzaj_koszulki==1 && wybrany_kolor==1){
	$('.obrmaly[data-nr="7"]').closest('div').attr('popis', oddychajacatkanina);
	$('.obrmaly[data-nr="7"]').closest('div').attr('popisfoto',oddychajacatkaninaopis);
	$('.obrmaly[data-nr="5"]').closest('div').attr('popis',wygodnekieszenie);
	$('.obrmaly[data-nr="5"]').closest('div').attr('popisfoto',wygodnekieszenieopis);
	$('.obrmaly[data-nr="5"]').attr('src', _cdn+'/grafika/produkt'+katalog+'/'+nazwa+'5.jpg');
	$('.obrmaly[data-nr="7"]').attr('src', _cdn+'/grafika/produkt'+katalog+'/'+nazwa+'7.jpg');
	$('.obrmaly[data-nr="5"]').closest('div').attr('klasatekst','pozycje-teksty-10');
	$('.obrmaly[data-nr="6"]').closest('div').attr('klasatekst','pozycje-teksty-11');
	$('.obrmaly[data-nr="7"]').closest('div').attr('klasatekst','pozycje-teksty-12');
	$('.obrmaly[data-nr="5"]').closest('div').attr('klasaobszar','pozycje-obszary-10');
	$('.obrmaly[data-nr="6"]').closest('div').attr('klasaobszar','pozycje-obszary-11');
	$('.obrmaly[data-nr="7"]').closest('div').attr('klasaobszar','pozycje-obszary-12');
}else if(wybrana_plec=='m' && wybrany_rodzaj_koszulki==1 && wybrany_kolor==2){
	$('.obrmaly[data-nr="5"]').closest('div').attr('popis', oddychajacatkanina);
	$('.obrmaly[data-nr="5"]').closest('div').attr('popisfoto',oddychajacatkaninaopis);
	$('.obrmaly[data-nr="7"]').closest('div').attr('popis',wygodnekieszenie);
	$('.obrmaly[data-nr="7"]').closest('div').attr('popisfoto',wygodnekieszenieopis);
	$('.obrmaly[data-nr="5"]').attr('src', _cdn+'/grafika/produkt'+katalog+'/'+nazwa+'7.jpg');
	$('.obrmaly[data-nr="7"]').attr('src', _cdn+'/grafika/produkt'+katalog+'/'+nazwa+'5.jpg');
	$('.obrmaly[data-nr="5"]').closest('div').attr('klasatekst','pozycje-teksty-6');
	$('.obrmaly[data-nr="6"]').closest('div').attr('klasatekst','pozycje-teksty-5');
	$('.obrmaly[data-nr="7"]').closest('div').attr('klasatekst','pozycje-teksty-4');
	$('.obrmaly[data-nr="5"]').closest('div').attr('klasaobszar','pozycje-obszary-6');
	$('.obrmaly[data-nr="6"]').closest('div').attr('klasaobszar','pozycje-obszary-5');
	$('.obrmaly[data-nr="7"]').closest('div').attr('klasaobszar','pozycje-obszary-4');
}

var popis = $('.obrmaly[data-nr="5"]').closest('div').attr('popis');
$('.obrmaly[data-nr="5"]').attr('alt', popis);
$('.obrmaly[data-nr="5"]').attr('title', popis);
popis = $('.obrmaly[data-nr="6"]').closest('div').attr('popis');
$('.obrmaly[data-nr="6"]').attr('alt', popis);
$('.obrmaly[data-nr="6"]').attr('title', popis);
popis = $('.obrmaly[data-nr="7"]').closest('div').attr('popis');
$('.obrmaly[data-nr="7"]').attr('alt', popis);
$('.obrmaly[data-nr="7"]').attr('title', popis);


    miniatury_klikanie();

}

$('.potwierdz_podsumowanie').click(function(e){
    e.preventDefault();

    var ok = true;
	var byl_skok = false;

    if(!$('.regulamin_czek').find('input').is(':checked')){
	ok = false;
	$('.regulamin_czek').closest('tr').css('border', 'solid thin red');
	$('.regulamin_error').show();
		if(!byl_skok){
			do_bledu('.regulamin_czek');
			byl_skok = true;
		}
    }
    if(ok){

	var disab = $(".potwierdz_podsumowanie").attr("disabled");
	if(disab != "disabled"){
		//console.log('T');
	    $(".potwierdz_podsumowanie").attr("readonly", "readonly");
	    $(".potwierdz_podsumowanie").attr("disabled", "disabled");
	    $(".potwierdz_podsumowanie").attr("pointer-events", "none");
	    $(".potwierdz_podsumowanie").attr("cursor", "default");
	    $(".potwierdz_podsumowanie").attr("style", "background-color: #B1B6BA;background-image: none");
	    $(".potwierdz_podsumowanie").text(proszeczekac);

	    if($('.daneosobowe_czek').find('input').is(':checked')){
    		var daneosobowe = 1;
	    }else{
		var daneosobowe = 0;
	    }
	    var id_zam = $('.potwierdz_podsumowanie').attr('data-id_zam');
	    var kwota_laczna = $('.razem').attr('data-kwota_laczna');
	    var rabat = $('.razem').attr('data-rabat');
	    var koszt_wysylki = $('.razem').attr('data-koszt_wysylki');

	    if($( "#paypalform" ).length > 0){
		$.post("./ajax/koszyk.html", {akcja: "wyslij_zamowienie", daneosobowe:daneosobowe, kwota_laczna:kwota_laczna, rabat:rabat, koszt_wysylki:koszt_wysylki}).done(function(){
		    $.post("./ajax/mail.html", {akcja: "zlozenie", id_zam: id_zam}).done(function(datam){
		    });

		    $( "#item_name" ).val($( "#item_name" ).val()+" "+id_zam);
		    $( "#paypalform" ).submit();

		});
	    }else{
		$.post("./payment/paylane.html", {kwota_laczna: kwota_laczna, rabat:rabat, koszt_wysylki:koszt_wysylki}).done(function(data){
		    $.post("./ajax/mail.html", {akcja: "zlozenie", id_zam: id_zam}).done(function(datam){});
		    $.post("./ajax/koszyk.html", {akcja: "wyslij_zamowienie", daneosobowe:daneosobowe}).done(function(datar){
		//alert(data);
			if(data.trim() == "ok"){
			    window.location.href = 'https://'+_serwer+_sciezka+'/zamowienie.html';
			}else{
			    window.location.href = 'https://'+_serwer+_sciezka+'/podsumowanie.html';
                            console.log('zapłata nieudana powrót do podsumowania super');
			}
		    });
		});
	    }
	}else{
		//console.log('N');
	}
    }

});


miniatury_klikanie();

function do_bledu(el){
 $('html, body').animate({
        scrollTop: $(el).parent().parent().offset().top
    }, 100);
}

$('.dalej_dane_klienta').click(function(e){
    e.preventDefault();

    var imie = $('#imie').val();
    var nazwisko = $('#nazwisko').val();
    var firma = $('#firma').val();
    var email = $('#email').val();

    var adres = $('#adres').val();
    var adres2 = $('#adres2').val();
    var kod = $('#kod').val();
    var tel = $('#tel').val();
    var kraj = $('#kraj_dane_klienta').attr('data-id');
    if($('#woj').length > 0){
	var woj = $('#woj').find('option:selected', this).attr('data-id');
    }else{
	var woj = 0;
    }

    var miasto = $('#miejscowosc').val();
    var tekst = $('#form_dane_klienta').attr('data-uwaga');

    var ok = true;
	var byl_skok = false;

    if($('#imie').val() == ''){
	ok = false;
	$('#imie').parent().parent().find('span').empty().append(tekst);
	$('#imie').attr('data-blad', "1");
		if(!byl_skok){
			do_bledu('#imie');
			byl_skok = true;
		}
    }else{
	$('#imie').parent().parent().find('span').empty().append('*');
	$('#imie').attr('data-blad', "0");
    }

    if($('#nazwisko').val() == ''){
	ok = false;
	$('#nazwisko').parent().parent().find('span').empty().append(tekst);
	$('#nazwisko').attr('data-blad', "1");
		if(!byl_skok){
			do_bledu('#nazwisko');
			byl_skok = true;
		}
	}else{
	$('#nazwisko').attr('data-blad', "0");
	$('#nazwisko').parent().parent().find('span').empty().append('*');
    }

    if($('#email').val() == '' || !email_ok($('#email').val())){
	ok = false;
	$('#email').parent().parent().find('span').empty().append(tekst);
	$('#email').attr('data-blad', "1");
		if(!byl_skok){
			do_bledu('#email');
			byl_skok = true;
		}
    }else{
	$('#email').attr('data-blad', "0");
	$('#email').parent().parent().find('span').empty().append('*');
    }

    if($('#adres').val() == ''){
	ok = false;
	$('#adres').parent().parent().find('span').empty().append(tekst);
	$('#adres').attr('data-blad', "1");
		if(!byl_skok){
			do_bledu('#adres');
			byl_skok = true;
		}
    }else{
	$('#adres').parent().parent().find('span').empty().append('*');
	$('#adres').attr('data-blad', "0");
    }

    if($('#kod').val() == ''){
	ok = false;
	$('#kod').parent().parent().find('span').empty().append(tekst);
	$('#kod').attr('data-blad', "1");
		if(!byl_skok){
			do_bledu('#kod');
			byl_skok = true;
		}
	}else{
	$('#kod').attr('data-blad', "0");
	$('#kod').parent().parent().find('span').empty().append('*');
    }

    if($('#miejscowosc').val() == ''){
	ok = false;
	$('#miejscowosc').parent().parent().find('span').empty().append(tekst);
	$('#miejscowosc').attr('data-blad', "1");
		if(!byl_skok){
			do_bledu('#miejscowosc');
			byl_skok = true;
		}
    }else{
	$('#miejscowosc').attr('data-blad', "0");
	$('#miejscowosc').parent().parent().find('span').empty().append('*');
    }


    if(woj == 0 && $('#woj').length > 0){
	ok = false;
	$('#woj').parent().parent().find('span').empty().append(tekst);
		if(!byl_skok){
			do_bledu('#woj');
			byl_skok = true;
		}
    }else{
	$('#woj').parent().parent().find('span').empty().append('*');
    }

    if(kraj == 0){
	ok = false;
	$('#kraj_dane_klienta').parent().parent().find('span').empty().append(tekst);
		if(!byl_skok){
			do_bledu('#kraj_dane_klienta');
			byl_skok = true;
		}
	}else{
	$('#kraj_dane_klienta').parent().parent().find('span').empty().append('*');
    }

    if($('#tel').val() == ''){
	ok = false;
	$('#tel').parent().parent().find('span').empty().append(tekst);
	$('#tel').attr('data-blad', "1");
		if(!byl_skok){
			do_bledu('#tel');
			byl_skok = true;
		}
	}else{
	$('#tel').attr('data-blad', "0");
	$('#tel').parent().parent().find('span').empty().append('*');
    }

    if(ok){
			var nagranie = '';
			smartlook(function() {
				nagranie = smartlook.playUrl;
			});

			$.post("./ajax/koszyk.html", {akcja: "zapisz_dane_klienta", imie:imie, nazwisko:nazwisko, firma:firma, email:email, adres:adres, adres2:adres2, kod: kod, tel:tel, kraj: kraj, woj:woj, miasto:miasto, nagranie:nagranie}).done(function(data){


				//$.post("./ajax/koszyk.html", {akcja: "nagranie", nagranie:nagranie}).done(function(datan){

					window.location.href = 'https://'+_serwer+_sciezka+'/podsumowanie.html';
                                        console.log('Ale fajnie że działa');
				//});


			});




    }

});

$('.zapisz_dane_wysylki').click(function(e){
    e.preventDefault();

    $('#blednedanekarty').empty();

    var adres_wysylki;

    if($('#zam1').parent().hasClass('checked')){
	adres_wysylki = 'zam';
    }else{
	adres_wysylki = 'odb';
    }

    var typ_platnosci;
    if($('#platnosc').parent().hasClass('checked')){
	typ_platnosci = 1;
    }else{
	typ_platnosci = 2;
    }

    var ok = true;
	var byl_skok = false;

    var tekst = $('#form_wysylka').attr('data-uwaga');
    var tekst_bdk = $('#form_wysylka').attr('data-blednedanekarty');

    if(adres_wysylki == 'odb'){
	var imie = $('#imie').val();
	var nazwisko = $('#nazwisko').val();
	var firma = $('#firma').val();
	var email = $('#email').val();
	var adres = $('#adres').val();
	var adres2 = $('#adres2').val();
	var kod = $('#kod').val();
	var tel = $('#tel').val();
	var kraj = $('#kraj_wysylka').attr('data-id');
	if($('#woj').length > 0){
	    var woj = $('#woj').find('option:selected', this).attr('data-id');
	}else{
	    var woj = 0;
	}
	var miasto = $('#miejscowosc').val();


	if($('#imie').val() == ''){
	    ok = false;
	    $('#imie').parent().parent().find('span').empty().append(tekst);
		$('#imie').attr('data-blad', "1");
		if(!byl_skok){
			do_bledu('#imie');
			byl_skok = true;
		}
	}else{
	    $('#imie').parent().parent().find('span').empty().append('*');
		$('#imie').attr('data-blad', "0");
	}

	if($('#nazwisko').val() == ''){
	    ok = false;
	    $('#nazwisko').parent().parent().find('span').empty().append(tekst);
		$('#nazwisko').attr('data-blad', "1");
		if(!byl_skok){
			do_bledu('#nazwisko');
			byl_skok = true;
		}
	}else{
	    $('#nazwisko').parent().parent().find('span').empty().append('*');
		$('#nazwisko').attr('data-blad', "0");
	}

	if($('#email').val() == ''){
	    ok = false;
	    $('#email').parent().parent().find('span').empty().append(tekst);
		$('#email').attr('data-blad', "1");
		if(!byl_skok){
			do_bledu('#email');
			byl_skok = true;
		}
	}else{
	    $('#email').parent().parent().find('span').empty().append('*');
		$('#email').attr('data-blad', "0");
	}

	if($('#adres').val() == ''){
	    ok = false;
	    $('#adres').parent().parent().find('span').empty().append(tekst);
		$('#adres').attr('data-blad', "1");
		if(!byl_skok){
			do_bledu('#adres');
			byl_skok = true;
		}
	}else{
	    $('#adres').parent().parent().find('span').empty().append('*');
		$('#adres').attr('data-blad', "0");
	}

	if($('#kod').val() == ''){
	    ok = false;
	    $('#kod').parent().parent().find('span').empty().append(tekst);
		$('#kod').attr('data-blad', "1");
		if(!byl_skok){
			do_bledu('#kod');
			byl_skok = true;
		}
	}else{
	    $('#kod').parent().parent().find('span').empty().append('*');
		$('#kod').attr('data-blad', "0");
	}

	if($('#miejscowosc').val() == ''){
	    ok = false;
	    $('#miejscowosc').parent().parent().find('span').empty().append(tekst);
		$('#miejscowosc').attr('data-blad', "1");
		if(!byl_skok){
			do_bledu('#miejscowosc');
			byl_skok = true;
		}
	}else{
	    $('#miejscowosc').parent().parent().find('span').empty().append('*');
		$('#miejscowosc').attr('data-blad', "0");
	}

	if(woj == 0 && $('#woj').length > 0){
	    ok = false;
	    $('#woj').parent().parent().find('span').empty().append(tekst);
		if(!byl_skok){
			do_bledu('#woj');
			byl_skok = true;
		}
	}else{
	    $('#woj').parent().parent().find('span').empty().append('*');
	}

	if(kraj == 0){
	    ok = false;
	    $('#kraj_wysylka').parent().parent().find('span').empty().append(tekst);
		if(!byl_skok){
			do_bledu('#kraj_wysylka');
			byl_skok = true;
		}
	}else{
	    $('#kraj_wysylka').parent().parent().find('span').empty().append('*');
	}

	if($('#tel').val() == ''){
	    ok = false;
	    $('#tel').parent().parent().find('span').empty().append(tekst);
		$('#tel').attr('data-blad', "1");
		if(!byl_skok){
			do_bledu('#tel');
			byl_skok = true;
		}
	}else{
	    $('#tel').parent().parent().find('span').empty().append('*');
		$('#tel').attr('data-blad', "0");
	}

    }else{
	var imie = '';
	var nazwisko = '';
	var firma = '';
	var email = '';
	var adres = '';
	var adres2 = '';
	var kod = '';
	var tel = '';
	var kraj = 0;
	var woj = 0;
	var miasto = '';
    }

    if(typ_platnosci == 1){
	var wk = $('#wk').val();
	var nrk = $('#nrk').val();
	nrk = nrk.replace(/\s/g, '');;
	var kwk = $('#kwk').val();
	var mies = $('#mies').find('option:selected', this).attr('data-id');
	var rok = $('#rok').find('option:selected', this).attr('data-id');

	if($('#wk').val() == ''){
	    ok = false;
	    $('#wk').parent().parent().find('span').empty().append(tekst);
		if(!byl_skok){
			do_bledu('#wk');
			byl_skok = true;
		}
	}else{
	    $('#wk').parent().parent().find('span').empty().append('*');
	}

	if($('#nrk').val() == ''){
	    ok = false;
	    $('#nrk').parent().parent().find('span').empty().append(tekst);
		if(!byl_skok){
			do_bledu('#nrk');
			byl_skok = true;
		}
	}else{
	    $('#nrk').parent().parent().find('span').empty().append('*');
	}

	if(ok && !numer_karty_ok(nrk)){
	    ok = false;
	    $('#blednedanekarty').empty().append(tekst_bdk);
		if(!byl_skok){
			do_bledu('#blednedanekarty');
			byl_skok = true;
		}
	}

	if($('#kwk').val() == ''){
	    ok = false;
	    $('#kwk').parent().parent().find('span').empty().append(tekst);
		if(!byl_skok){
			do_bledu('#kwk');
			byl_skok = true;
		}
	}else{
	    $('#kwk').parent().parent().find('span').empty().append('*');
	}

	if(mies == 0){
	    ok = false;
	    $('#mies').parent().parent().find('span').empty().append(tekst);
		if(!byl_skok){
			do_bledu('#mies');
			byl_skok = true;
		}
	}else{
	    $('#mies').parent().parent().find('span').empty().append('*');
	}

	if(rok == 0){
	    ok = false;
	    $('#rok').parent().parent().find('span').empty().append(tekst);
		if(!byl_skok){
			do_bledu('#rok');
			byl_skok = true;
		}
	}else{
	    $('#rok').parent().parent().find('span').empty().append('*');
	}

	if(ok && !data_waznosci_ok(mies, rok)){
	    ok = false;
	    $('#blednedanekarty').empty().append(tekst_bdk);
		if(!byl_skok){
			do_bledu('#blednedanekarty');
			byl_skok = true;
		}
	}

    }else{
	var wk = '';
	var nrk = '';
	var kwk = '';
	var mies = 0;
	var rok = 0;
    }

    if(ok){

	$.post("./ajax/koszyk.html", {akcja: "zapisz_dane_wysylki", adres_wysylki:adres_wysylki, typ_platnosci:typ_platnosci, imie:imie, nazwisko:nazwisko, firma:firma, email:email, adres:adres, adres2:adres2, kod: kod, tel:tel, kraj: kraj, woj:woj, miasto:miasto, wk:wk, nrk:nrk, kwk:kwk, mies:mies, rok:rok}).done(function(data){
		//alert(data);
	    window.location.href = 'https://'+_serwer+_sciezka+'/podsumowanie.html';
	});
    }
});

function przywroc_pole_kod(){
	$('.koszyk-formularz-f-1-blad').click(function(){
		$(this).empty().append('<input class="wpisz_kod" name="in" value="" type="text">');
		$(this).removeClass("koszyk-formularz-f-1-blad");
		$(this).find('.wpisz_kod').focus();
	});
}

$(".zastosuj").click(function(e){
    e.preventDefault();
    $('.koszyk-formularz-f-1-text-blad').remove();
    //$('.koszyk-formularz-f-1-blad').removeClass("koszyk-formularz-f-1-blad").addClass('koszyk-formularz-f-1');
	$('.koszyk-formularz-f-1-blad').removeClass("koszyk-formularz-f-1-blad");
    var kraj = $(this).find('option:selected', this).attr('data-id');
    var kod = $('.wpisz_kod').val();
    var tekst1 = $('#koszykform').attr('data-blednykod');
    var tekst2 = $('#koszykform').attr('data-wykorzystanykod');

    $.post("./ajax/koszyk.html", {akcja: "rabat", kraj: kraj, kod: kod}).done(function(data){

	if(data == 'blad'){

		$('.koszyk-formularz-f-1').addClass('koszyk-formularz-f-1-blad');
	    var tekst = '<div class="koszyk-formularz-f-1-text-blad" style="color:#E84E50;margin-top:8px;margin-right:5px;font-size:18px">'+tekst1+'</div>';
	    $('.koszyk-formularz-f-1-blad').empty().append(tekst);
		przywroc_pole_kod();

	}else if(data == 'wpisany'){
	    $('.koszyk-formularz-f-1').addClass('koszyk-formularz-f-1-blad');
	    var tekst = '<div class="koszyk-formularz-f-1-text-blad" style="color:#E84E50;margin-top:8px;margin-right:5px;font-size:18px">'+tekst2+'</div>';
	    $('.koszyk-formularz-f-1-blad').empty().append(tekst);
		przywroc_pole_kod();

	}else{
	    var arr = data.split(':');
	    var rodzaj = arr[0];
	    var rabat = arr[1];
	    var hurt = arr[2];
	    var hurt_typ = arr[3];
	    var hurt_ilosc = arr[4];

	    $('.rabat').attr('data-rabat', rabat);
	    $('.rabat').attr('data-rodzaj', rodzaj);
	    $('.rabat').attr('data-hurt', hurt);
	    $('.rabat').attr('data-hurt_typ', hurt_typ);
	    $('.rabat').attr('data-hurt_ilosc', hurt_ilosc);

	    oblicz_kwote_laczna(waluta, pozycja_symbolu);
	}

    });

});

    if($(".kwota_laczna").length > 0 && $(".kwota_laczna").val() == ""){

	oblicz_kwote_laczna(waluta, pozycja_symbolu);
    }


    $('#checkBox-powloka').change(()=>{
      oblicz_kwote_laczna(waluta, pozycja_symbolu);

    });
    $('.wybierzjezyk li').click(function(){
	var jezyk = $(this).attr('data-lang');

	//$.cookie('lang', jezyk, { path:'/', expires: 30 });
	$.post("./ajax/ciastko.html", {nazwa: "lang", wartosc: jezyk});
	$.post("./ajax/koszyk.html", {akcja: "czysc_koszyk"}).done(function(data){
		var sciezka = window.location.pathname;

		$('.wybierzjezyk li').each(function(ind, el){
			var jz = $(el).attr('data-lang');
			jz = '/'+jz;

			if(sciezka.indexOf(jz) != -1){
				sciezka = sciezka.substring(jz.length);
			}
    		});

	    	window.location.href = window.location.protocol+'//'+window.location.hostname+'/'+jezyk+sciezka;
	});
    });


    $('.plec').bind("ifClicked", przeladuj_oferte);
    $('.rodzaje_koszulek').bind("change", przeladuj_oferte);
    $('.rozmiary').bind("change", przeladuj_oferte);
    $('.kolory').bind("ifClicked", zmien_kolor);

    if($("#platnosc").is(":checked")){
	$('.kartakredytowa').show();
    }else{
	$('.kartakredytowa').hide();
    }

    $('#platnosc2').bind("ifClicked", function(){
	$('.kartakredytowa').hide();
	$('#logopaypal').attr("src", _cdn+"/grafika/loga-p-2.jpg");
    });

    $('#platnosc').bind("ifClicked", function(){
	$('.kartakredytowa').show();
	$('#logopaypal').attr("src", _cdn+"/grafika/loga-p-2-s.jpg");
    });

    $('#aplatnosc2').click(function(e){
	e.preventDefault();
	$('.kartakredytowa').hide();
	$('#platnosc2').iCheck('check');
	$('#platnosc').iCheck('uncheck');
	$('#logopaypal').attr("src", _cdn+"/grafika/loga-p-2.jpg");

    });

    $('#aplatnosc').click(function(e){
	e.preventDefault();
	$('.kartakredytowa').show();
	$('#platnosc').iCheck('check');
	$('#platnosc2').iCheck('uncheck');
	$('#logopaypal').attr("src", _cdn+"/grafika/loga-p-2-s.jpg");

    });


    $('.dodaj-do-koszyka input[type="submit"]').click(function(e){

	    e.preventDefault();
	    var typ_towaru = 1;
	    if($('.plec[data-id="m"]').parent().hasClass("checked")){
		var wybrana_plec = 'm';
		var wybrany_rodzaj_koszulki = $('.rodzaje_koszulek').find('option:selected', this).attr('data-id');
	    }else{
		var wybrana_plec = 'k';
		var wybrany_rodzaj_koszulki = 2;
	    }

	    var wybrany_rozmiar = $('.rozmiary').find('option:selected', this).attr('data-id');

	    var wybrany_kolor = 0;
	    $('.kolory').each(function(ind,el){
		if($(el).parent().hasClass("checked")){
		    wybrany_kolor = $(el).attr('data-id');;
		}
	    });

	$.post("./ajax/koszyk.html", {akcja: "dodaj", typ_towaru: typ_towaru, wybrana_plec: wybrana_plec, wybrany_rodzaj_koszulki: wybrany_rodzaj_koszulki, wybrany_rozmiar: wybrany_rozmiar, wybrany_kolor: wybrany_kolor}).done(function(data){

	    window.location.href = 'https://'+_serwer+_sciezka+'/koszyk.html';
	});
    });

    $('.dodaj-do-koszyka-dod').click(function(e){
	e.preventDefault();
	var typ_towaru = $(this).closest(".produkt_dodatkowy").attr('data-typ');
	$.post("./ajax/koszyk.html", {akcja: "dodaj_dod", typ_towaru: typ_towaru}).done(function(data){
	    window.location.href = 'https://'+_serwer+_sciezka+'/koszyk.html';
	});
    });





$('#emailnews').on('focus', function(){
    $('#errnews').attr('style', 'color:white');
	$('#errnews').empty().append('');
});

$('#emailnews').on('blur', function(){
	var tekst = $('.newsletter').attr('data-uwaga');
	if($(this).val() == ''){
		$('#errnews').attr('style', 'color:#e84e50');
		$('#errnews').empty().append(tekst);
	}
});

$('.input_dane_klienta').on('focus', function(){
    $(this).parent().find('span').attr('style', 'color:white');
	$(this).parent().find('span').empty().append('*');
});

$('.input_dane_klienta').on('blur', function(){
	var tekst = $('#form_dane_klienta').attr('data-uwaga');
	if($(this).val() == ''){
		$(this).parent().find('span').empty().append(tekst);
		$(this).parent().find('span').attr('style', 'color:#e84e50');
	}
});

$('.input_wysylka').on('focus', function(){
    $(this).parent().find('span').attr('style', 'color:white');
	$(this).parent().find('span').empty().append('*');
});

$('.input_wysylka').on('blur', function(){
	var tekst = $('#form_wysylka').attr('data-uwaga');
	if($(this).val() == ''){
		$(this).parent().find('span').empty().append(tekst);
		$(this).parent().find('span').attr('style', 'color:#e84e50');
	}
});


$('#wyslijnews').click(function(e){
		e.preventDefault();
		var tekst = $('.newsletter').attr('data-uwaga');
		if($('#emailnews').val() == '' || !email_ok($('#emailnews').val())){
			$('#errnews').empty().append(tekst);
		}else{
			$('#errnews').empty();
			var email = $('#emailnews').val();
			$.post("./ajax/newsletter.html", {email: email}).done(function(data){
				if(data.trim() == "ok"){
					$('#nagloweknews').empty().append(nagloweknews);
					$('#trescnews').empty().append(trescnews);
					$('#polanews').empty();
				}
			});
			}

	});

//Zamykanie ciastek kliknieciem poza elementem

//$(window).click(function() {
//});
//$('.info-cookies').click(function(event){
//    event.stopPropagation();
//});
//koniec Zamykanie ciastek kliknieciem poza elementem
klik = 1;

function plusminus()
{

  $( ".plus" ).click(function(e) {

    ileplusminus = $(this).next().next().val();

	ileplusminus++;
    $(this).next().next().val(ileplusminus);
    var klucz = $(this).closest("tr").attr('data-klucz');
    var cenaj = parseFloat($(this).closest("tr").attr('data-cenaj'));
    $.post("./ajax/koszyk.html", {akcja: "plus", klucz: klucz});
    var wartosc = ileplusminus * cenaj;
    wartosc = Math.round(wartosc*100)/100;
    $(this).closest("tr").find(".wartosc").empty().append(wartosc.toFixed(2));
    $(this).closest("tr").attr('data-cena', wartosc.toFixed(2));
    var ile = parseInt($(".ile").html());
    ile++;
    $(".ile").empty().append(ile);
    oblicz_kwote_laczna(waluta, pozycja_symbolu);


  });


  $( ".minus" ).click(function(e) {
    ileplusminus = $(this).next().val();

    if(ileplusminus > 1)
    {
        ileplusminus--;
        $(this).next().val(ileplusminus);
	var klucz = $(this).closest("tr").attr('data-klucz');
	var cenaj = parseFloat($(this).closest("tr").attr('data-cenaj'));
	$.post("./ajax/koszyk.html", {akcja: "minus", klucz: klucz});
	var ile = parseInt($(".ile").html());

	ile--;
	$(".ile").empty().append(ile);
	var wartosc = ileplusminus * cenaj;
	wartosc = Math.round(wartosc*100)/100;
	$(this).closest("tr").find(".wartosc").empty().append(wartosc.toFixed(2));
	$(this).closest("tr").attr('data-cena', wartosc.toFixed(2));
	oblicz_kwote_laczna(waluta, pozycja_symbolu);
    }

  });

  $( ".usun_z_koszyka" ).click(function(e) {
    e.preventDefault();
    var klucz = $(this).closest("tr").attr('data-klucz');
    $.post("./ajax/koszyk.html", {akcja: "usun", klucz: klucz}).done(function(data){
	if(data == "pusty"){
	    window.location.href = 'https://'+_serwer+_sciezka+'/koszyk-pusty.html';
	}else{
	    location.reload();
	}
    });

  });

}

plusminus();

$(".linkprawa").on("click", function(event){
    if ($(this).is("[disabled]")) {
        event.preventDefault();
    }
});

$(".kraje_koszyk").change(function(){
    var koszt = $(this).find('option:selected', this).attr('data-koszt');

    var krid = $(this).find('option:selected', this).attr('data-id');
    $('.koszt_wysylki .wartosc').empty().append(koszt);
    $('.koszt_wysylki').attr('data-koszt', koszt);
    $.post("./ajax/koszyk.html", {akcja: "kraj", krid: krid});
    oblicz_kwote_laczna(waluta, pozycja_symbolu);
});


$('.regulamin_czek input').click(function(){
    if($(this).is(':checked')){
	$('.regulamin_czek').closest('tr').css('border', 'none');
	$('.regulamin_error').hide();
    }else{
	$('.regulamin_czek').closest('tr').css('border', 'solid thin red');
	$('.regulamin_error').show();
    }
});
$('.zamawiam_koszyk').click(function(e){
    e.preventDefault();
    $.post("./ajax/koszyk.html", {akcja: "zacznij_zamawianie"}).done(function(data){
	window.location.href = 'https://'+_serwer+_sciezka+'/dane-klienta.html';
    });
});


if($("#zam1").is(":checked")){
    //$('.zamawiajacy').show();
    $('.odbiorca').hide();
}else{
    //$('.zamawiajacy').hide();
    $('.odbiorca').show();
}


$('#zam1').on('ifChecked', function(event){
    //$('.zamawiajacy').show();
    $('.odbiorca').hide();
});

$('#zam2').on('ifChecked', function(event){
    //$('.zamawiajacy').hide();
    $('.odbiorca').show();
});

function zamknijkontakt()
{

  $('.wiadomosci-c-mail').click(function(){

      $('.tlo-wiadomosci, .wiadomosci').fadeOut();
	  location.reload();

  });

  $('.info-cookies-zam2').click(function(){

       $('.info-cookies').hide();
	   $.post("./ajax/ciastko.html", {nazwa: "ciastkow", wartosc: "1"}).done(function(data){
	   });
});

$('.wiadomosci-c-news').click(function(){

	$('.newsletter').hide();
	$('.tlo-wiadomosci, .wiadomosci').fadeOut();
	if($('#polanews input').length > 0){
	   $.post("./ajax/ciastko.html", {nazwa: "ciastkon", wartosc: "0"}).done(function(data){
	   });
	}


});

}
zamknijkontakt();




function pomoc()
{



  //$('.formularze-pomoc').mouseenter(function() {
  $('.formularze-pomoc').click(function() {

    $(this).find(".formularze-pomoc-text").show();

    szerokc = $(window).width();

    if(szerokc < 1050)
    {


      formularzepomoc_offset = $('.formularze-pozycja').position();

      poz_l_of = formularzepomoc_offset.left;

      //alert(poz_l_of);

      szerokc_p = $(window).width();
      $('.formularze-pomoc-text').css('width',szerokc_p-140);

    }


  })
  .mouseleave(function() {
    $(this).find(".formularze-pomoc-text").hide();
  });



}

pomoc();



function pomoc2()
{



  //$('.formularze-pomoc2').mouseenter(function() {
    $('.formularze-pomoc2').click(function() {

    $(this).find(".formularze-pomoc-text").show();

    szerokc = $(window).width();

    if(szerokc < 1050)
    {


      formularzepomoc_offset = $('.formularze-pozycja').position();

      poz_l_of = formularzepomoc_offset.left;

      //alert(poz_l_of);

      szerokc_p = $(window).width();
      $('.formularze-pomoc-text').css('width',szerokc_p-140);

    }


  })
  .mouseleave(function() {
    $(this).find(".formularze-pomoc-text").hide();
  });



}

pomoc2();



function aktywne_pola()
{

   $('body .pozycje-aktywne-poz').each(function(index, el){
               var klaszaobszar = $(el).attr('klaszaobszar');



         //$(this).css({'left':jeden_pakt_left,'top':jeden_pakt_top,'width':jeden_pakt_szer,'height':jeden_pakt_wys});
		$(el).attr("class", "pozycje-aktywne-poz "+klasaobszar);

   });


}



function miniatury_wys()
{

    $('body .min-p').each(function( index ) {

        var atrszerwyb =  $(this).width();

        $('body .min-p').css('height',atrszerwyb);


    });


}


function miniatury_klikanie()
{

        $(window).scroll(function(){

		if($('.produkt-zdjecie-galeria img').length > 0){
        	    zscrol = $(this).scrollTop();

        	    pozobaktokna2 = $('.produkt-zdjecie-galeria img').offset();

        	    $('body #galeria-obrazek').css('top',pozobaktokna2.top-zscrol);

		}
        });


    $('body .min-p').each(function( index ) {



        if(index == 0)
        {


            $("body .pozycje-aktywne-poz").remove();
            $("body .pozycje-aktywne-poz-text").remove();

            $(this).children('.miniaura-akt').each(function( index2, el2 ){


                pakt_left = $(el2).attr('pleft');
                pakt_top = $(el2).attr('ptop');
                pakt_szer = $(el2).attr('pwidth');
                pakt_wys = $(el2).attr('pheight');

                pakt_src = $(el2).children().attr('src');
                popis = $(el2).attr('popis');
                popisfoto = $(el2).attr('popisfoto');
				klasatekst = $(el2).attr('klasatekst');
				klasaobszar = $(el2).attr('klasaobszar');

                $(".produkt-zdjecie-galeria").append('<div class="pozycje-aktywne-poz '+klasaobszar+'" popisfoto="'+popisfoto+'" psrc="'+pakt_src+'" style="position:absolute;cursor:pointer;z-index:99999;"></div>');

				$(".produkt-zdjecie-galeria").append('<div class="pozycje-aktywne-poz-text '+klasatekst+'" style="position:absolute">'+popis+'</div>');
            });

        }

    });



    $('body .min-p img').click(function() {


        var atrscieszkaob =  $(this).attr('src');
		//var atralt =  $(this).attr('alt');
		//var atrtitle =  $(this).attr('title');

		atrscieszkaob = atrscieszkaob.replace('m.','.');

        $('body .produkt-zdjecie-galeria img').attr('src',atrscieszkaob);
		//$('body .produkt-zdjecie-galeria img').attr('alt',atralt);
		//$('body .produkt-zdjecie-galeria img').attr('title',atrtitle);

        $("body .pozycje-aktywne-poz").remove();
		$("body .pozycje-aktywne-poz-text").remove();

        $(this).parent().children('.miniaura-akt').each(function( index2, el2 ){

                pakt_left = $(el2).attr('pleft');
                pakt_top = $(el2).attr('ptop');
                pakt_szer = $(el2).attr('pwidth');
                pakt_wys = $(el2).attr('pheight');

                pakt_src = $(el2).children().attr('src');
                popis = $(el2).attr('popis');
                popisfoto = $(el2).attr('popisfoto');
				klasatekst = $(el2).attr('klasatekst');
				klasaobszar = $(el2).attr('klasaobszar');

				$(".produkt-zdjecie-galeria").append('<div class="pozycje-aktywne-poz '+klasaobszar+'" popisfoto="'+popisfoto+'" psrc="'+pakt_src+'" style="position:absolute;cursor:pointer;z-index:99999;"></div>');

				$(".produkt-zdjecie-galeria").append('<div class="pozycje-aktywne-poz-text '+klasatekst+'" style="position:absolute;">'+popis+'</div>');

        });

        $('body .pozycje-aktywne-poz').click(function(){

              atrsrcpolatlo = $(this).attr('psrc');
				popisfoto2 = $(this).attr('popisfoto');

              $("#galeria-tlo, #galeria-obrazek").remove();

              $('body').append('<div id="galeria-tlo"></div><div id="galeria-obrazek"><div id="galeria-obrazek-zam">x</div><div id="galeria-obrazek-opisy">'+popisfoto2+'</div><img id="g-image" src="'+atrsrcpolatlo+'" alt="'+popisfoto2+'" title="'+popisfoto2+'"></div>');


              pozobaktokna = $('.produkt-zdjecie-galeria img').offset();

              wys_z_okna = $('.produkt-zdjecie-galeria img').height();

              szer_z_okna = $('.produkt-zdjecie-galeria img').width();

              scrollt = $(window).scrollTop();

              $('body #galeria-obrazek').css({'top':pozobaktokna.top-scrollt,'left':pozobaktokna.left,'width':szer_z_okna,'height':wys_z_okna});

              $('body #galeria-obrazek img').css({'width':szer_z_okna,'height':wys_z_okna});


              $('#galeria-obrazek, #galeria-tlo').fadeIn();

              $('#galeria-obrazek').click(function(){

                  $('#galeria-obrazek, #galeria-tlo').fadeOut();

              });

        });



        //aktywne_pola();

    })



        $('body .pozycje-aktywne-poz').click(function(){

              atrsrcpolatlo = $(this).attr('psrc');

              popisfoto2 = $(this).attr('popisfoto');

              $("#galeria-tlo, #galeria-obrazek").remove();



              $('body').append('<div id="galeria-tlo"></div><div id="galeria-obrazek"><div id="galeria-obrazek-zam">x</div><div id="galeria-obrazek-opisy">'+popisfoto2+'</div><img id="g-image" src="'+atrsrcpolatlo+'" alt="'+popisfoto2+'" title="'+popisfoto2+'"></div>');


              pozobaktokna = $('.produkt-zdjecie-galeria img').offset();

              wys_z_okna = $('.produkt-zdjecie-galeria img').height();

              szer_z_okna = $('.produkt-zdjecie-galeria img').width();

              scrollt = $(window).scrollTop();

              $('body #galeria-obrazek').css({'top':pozobaktokna.top-scrollt,'left':pozobaktokna.left,'width':szer_z_okna,'height':wys_z_okna});

              $('body #galeria-obrazek img').css({'width':szer_z_okna,'height':wys_z_okna});


              $('#galeria-obrazek, #galeria-tlo').fadeIn();

              $('#galeria-obrazek').click(function(){

                  $('#galeria-obrazek, #galeria-tlo').fadeOut();

              });

        });


	//$("#galeria-obrazek").localize();




}

miniatury_wys();

//miniatury_klikanie();

//aktywne_pola();



function wybierz()
{
    $('body .f-wybierz ul li').each(function( index ) {
        atrwyb =  $(this).attr('selected');
        if(atrwyb == 'selected')
        {
           atrsrc = $(this).children().attr('src');
           $("#f-image").remove();
           $('body .f-wybierz .f-wybierz-s').prepend('<img id="f-image" src="'+atrsrc+'">');
        }
    });
    $('body .f-wybierz ul li').click(function() {
       $("#f-image").remove();
       atrsrc = $(this).children().attr('src');
       atrlink = $(this).attr('link');
       $("#f-image").remove();
       $('body .f-wybierz .f-wybierz-s').prepend('<img id="f-image" src="'+atrsrc+'">');
       $('body .f-wybierz ul').hide();
       //location.href = atrlink;
    });
    $('body .f-wybierz-s, body .f-wybierz-st').click(function() {

		if($('body .f-wybierz ul').attr("style") == "display: block;"){
			$('body .f-wybierz ul').hide();
		}else{
			$('body .f-wybierz ul').show();
		}

    });
}



wybierz();

    function menu()
{
   szer = $(window).width();
   if(szer > 767)
   {
      $(".menu").show();
      zm = 1;
   }
   else
   {
     $(".menu").hide();
     zm = 2;
   }
    $('.menu-m-p').off("click");
    $(".menu-m-p").on("click",function() {
               if(zm == 2)
               {
                    $(".menu").fadeIn(400);
                    zm = 1;
               }
               else
               {
                   $(".menu").fadeOut(400);
                   zm = 2;
               }
    });
}
menu();



$(window).bind('resize', function(e)
{
    window.resizeEvt;
    $(window).resize(function()
    {
        clearTimeout(window.resizeEvt);
        window.resizeEvt = setTimeout(function()
        {

           menu();

           miniatury_wys();

           //aktywne_pola();


         }, 50);
    });
});


$('#nazwiskokontakt, #emailkontakt, #telkontakt').on('focus', function(){
    $(this).parent().find('span').attr('style', 'color:white');
	$(this).parent().find('span').empty().append('');
});

$('#nazwiskokontakt, #emailkontakt, #telkontakt').on('blur', function(){
	var tekst = $('#wyslijmail').attr('data-uwaga');
	if($(this).val() == ''){
		$(this).parent().find('span').empty().append(tekst);
		$(this).parent().find('span').attr('style', 'color:#e84e50');
	}
});

//$('#wyslijmail').submit(function(e){
$('.wyslijmailsubmit').click(function(e){
	e.preventDefault();

	$('.mailblad').hide();

	var nazwisko = $('#nazwiskokontakt').val();
	var email = $('#emailkontakt').val();
	var tel = $('#telkontakt').val();
	var mail = $('#mailkontakt').val();
	var tekst = $('#wyslijmail').attr('data-uwaga');

	var ok = true;
	var tel_lub_email_ok = false;
	var byl_skok = false;

	if($('#nazwiskokontakt').val() == ''){
	    ok = false;
	    $('#nazwiskokontakt').parent().find('span').empty().append(tekst);
		$('#nazwiskokontakt').attr('data-blad', "1");
		if(!byl_skok){
			do_bledu('#nazwiskokontakt');
			byl_skok = true;
		}
	}else{
	    $('#nazwiskokontakt').parent().find('span').empty();
		$('#nazwiskokontakt').attr('data-blad', "0");
	}

	if($('#emailkontakt').val() == '' || !email_ok(email)){
	    //ok = false;
	    $('#emailkontakt').parent().find('span').empty().append(tekst);
		$('#emailkontakt').attr('data-blad', "1");
		if(!byl_skok){
			do_bledu('#emailkontakt');
			byl_skok = true;
		}
	}else{
		tel_lub_email_ok = true;
	    $('#emailkontakt').parent().find('span').empty();
		$('#emailkontakt').attr('data-blad', "0");
	}

	if($('#telkontakt').val() == ''){
	    //ok = false;
	    $('#telkontakt').parent().find('span').empty().append(tekst);
		$('#telkontakt').attr('data-blad', "1");
		if(!byl_skok){
			do_bledu('#telkontakt');
			byl_skok = true;
		}
	}else{
		tel_lub_email_ok = true;
	    $('#telkontakt').parent().find('span').empty();
		$('#telkontakt').attr('data-blad', "0");
	}

	if(mail == '' || !tel_lub_email_ok){
	    ok = false;
	}

	if($('#emailkontakt').val() == ''){
	    email = '';
	}
	if($('#telkontakt').val() == ''){
	    tel = '';
	}
	if(!ok){
		$('.mailblad').show();
	}

	if(ok){

    	    smartlook('tag', 'name', nazwisko);
    	    smartlook('tag', 'email', email);

		var nagranie = '';
		smartlook(function() {
			nagranie = smartlook.playUrl;
		});
			$.post("./ajax/mail.html", {akcja:"kontakt", nazwisko: nazwisko, email:email, tel: tel, mail:mail, nagranie:nagranie}).done(function(data){
				if(data.trim() == "ok"){
					$('#wyslijmail')[0].reset();

					//$('#nazwiskokontakt').val($('#nazwiskokontakt').attr('data-err'));
					//$('#emailkontakt').val($('#emailkontakt').attr('data-err'));
					//$('#telkontakt').val($('#telkontakt').attr('data-err'));
					$('#mailkontakt').val('');
					$('.input_mail').attr('data-wpis', 0);

					$('.mailok').show();
					$('.tlo-wiadomosci, .wiadomosci').show();

				}

			});

	}
   });




String.prototype.toCardFormat = function () {
	return this.replace(/[^0-9]/g, "").substr(0, 16).split("").reduce(cardFormat, "");
        function cardFormat(str, l, i) {
                return str + ((!i || (i % 4)) ? "" : " ") + l;
        }
};



    $('#nrk').keyup(function() {

	var tekst = $(this).val().replace(/\s/g, '');
	if(tekst != ""){
//console.log(to_dis(tekst));
//console.log(to_mae(tekst));
//console.log(moze_dis(tekst));

	if(to_dis(tekst)){
		$("#logovisa").attr("src", _cdn+"/grafika/visa-s.png"+"?"+Math.random());
		$("#logomc").attr("src", _cdn+"/grafika/mc-s.png"+"?"+Math.random());
		$("#logoae").attr("src", _cdn+"/grafika/ae-s.png"+"?"+Math.random());
	    $("#logodc").attr("src", _cdn+"/grafika/dc-s.png"+"?"+Math.random());
		$("#logojcb").attr("src", _cdn+"/grafika/jcb-s.png"+"?"+Math.random());
		$("#logodis").attr("src", _cdn+"/grafika/dis.png"+"?"+Math.random());
		$("#logomae").attr("src", _cdn+"/grafika/mae-s.png"+"?"+Math.random());
		}else if(to_jcb(tekst)){
		$("#logovisa").attr("src", _cdn+"/grafika/visa-s.png"+"?"+Math.random());
		$("#logomc").attr("src", _cdn+"/grafika/mc-s.png"+"?"+Math.random());
		$("#logoae").attr("src", _cdn+"/grafika/ae-s.png"+"?"+Math.random());
	    $("#logodc").attr("src", _cdn+"/grafika/dc-s.png"+"?"+Math.random());
		$("#logojcb").attr("src", _cdn+"/grafika/jcb.png"+"?"+Math.random());
		$("#logodis").attr("src", _cdn+"/grafika/dis-s.png"+"?"+Math.random());
		$("#logomae").attr("src", _cdn+"/grafika/mae-s.png"+"?"+Math.random());
	    }else if(to_mc(tekst)){
		$("#logovisa").attr("src", _cdn+"/grafika/visa-s.png"+"?"+Math.random());
		$("#logomc").attr("src", _cdn+"/grafika/mc.png"+"?"+Math.random());
		$("#logoae").attr("src", _cdn+"/grafika/ae-s.png"+"?"+Math.random());
	    $("#logodc").attr("src", _cdn+"/grafika/dc-s.png"+"?"+Math.random());
		$("#logojcb").attr("src", _cdn+"/grafika/jcb-s.png"+"?"+Math.random());
		$("#logodis").attr("src", _cdn+"/grafika/dis-s.png"+"?"+Math.random());
		$("#logomae").attr("src", _cdn+"/grafika/mae-s.png"+"?"+Math.random());
	    }else if(to_dc(tekst)){
		$("#logovisa").attr("src", _cdn+"/grafika/visa-s.png"+"?"+Math.random());
		$("#logomc").attr("src", _cdn+"/grafika/mc-s.png"+"?"+Math.random());
		$("#logoae").attr("src", _cdn+"/grafika/ae-s.png"+"?"+Math.random());
	    $("#logodc").attr("src", _cdn+"/grafika/dc.png"+"?"+Math.random());
		$("#logojcb").attr("src", _cdn+"/grafika/jcb-s.png"+"?"+Math.random());
		$("#logodis").attr("src", _cdn+"/grafika/dis-s.png"+"?"+Math.random());
		$("#logomae").attr("src", _cdn+"/grafika/mae-s.png"+"?"+Math.random());
	    }else if(to_ae(tekst)){
		$("#logovisa").attr("src", _cdn+"/grafika/visa-s.png"+"?"+Math.random());
		$("#logomc").attr("src", _cdn+"/grafika/mc-s.png"+"?"+Math.random());
		$("#logoae").attr("src", _cdn+"/grafika/ae.png"+"?"+Math.random());
	    $("#logodc").attr("src", _cdn+"/grafika/dc-s.png"+"?"+Math.random());
		$("#logojcb").attr("src", _cdn+"/grafika/jcb-s.png"+"?"+Math.random());
		$("#logodis").attr("src", _cdn+"/grafika/dis-s.png"+"?"+Math.random());
		$("#logomae").attr("src", _cdn+"/grafika/mae-s.png"+"?"+Math.random());
		}else if(to_mae(tekst) && !moze_dis(tekst)){

		$("#logovisa").attr("src", _cdn+"/grafika/visa-s.png"+"?"+Math.random());
		$("#logomc").attr("src", _cdn+"/grafika/mc-s.png"+"?"+Math.random());
		$("#logoae").attr("src", _cdn+"/grafika/ae-s.png"+"?"+Math.random());
	    $("#logodc").attr("src", _cdn+"/grafika/dc-s.png"+"?"+Math.random());
		$("#logojcb").attr("src", _cdn+"/grafika/jcb-s.png"+"?"+Math.random());
		$("#logodis").attr("src", _cdn+"/grafika/dis-s.png"+"?"+Math.random());
		$("#logomae").attr("src", _cdn+"/grafika/mae.png"+"?"+Math.random());
	    }else if(to_visa(tekst)){
		$("#logovisa").attr("src", _cdn+"/grafika/visa.png"+"?"+Math.random());
		$("#logomc").attr("src", _cdn+"/grafika/mc-s.png"+"?"+Math.random());
		$("#logoae").attr("src", _cdn+"/grafika/ae-s.png"+"?"+Math.random());
	    $("#logodc").attr("src", _cdn+"/grafika/dc-s.png"+"?"+Math.random());
		$("#logojcb").attr("src", _cdn+"/grafika/jcb-s.png"+"?"+Math.random());
		$("#logodis").attr("src", _cdn+"/grafika/dis-s.png"+"?"+Math.random());
		$("#logomae").attr("src", _cdn+"/grafika/mae-s.png"+"?"+Math.random());
		}else{
		$("#logovisa").attr("src", _cdn+"/grafika/visa-s.png"+"?"+Math.random());
		$("#logomc").attr("src", _cdn+"/grafika/mc-s.png"+"?"+Math.random());
		$("#logoae").attr("src", _cdn+"/grafika/ae-s.png"+"?"+Math.random());
	    $("#logodc").attr("src", _cdn+"/grafika/dc-s.png"+"?"+Math.random());
		$("#logojcb").attr("src", _cdn+"/grafika/jcb-s.png"+"?"+Math.random());
		$("#logodis").attr("src", _cdn+"/grafika/dis-s.png"+"?"+Math.random());
		$("#logomae").attr("src", _cdn+"/grafika/mae-s.png"+"?"+Math.random());
		}
	}else{
		$("#logovisa").attr("src", _cdn+"/grafika/visa-s.png"+"?"+Math.random());
		$("#logomc").attr("src", _cdn+"/grafika/mc-s.png"+"?"+Math.random());
		$("#logoae").attr("src", _cdn+"/grafika/ae-s.png"+"?"+Math.random());
	    $("#logodc").attr("src", _cdn+"/grafika/dc-s.png"+"?"+Math.random());
		$("#logojcb").attr("src", _cdn+"/grafika/jcb-s.png"+"?"+Math.random());
		$("#logodis").attr("src", _cdn+"/grafika/dis-s.png"+"?"+Math.random());
		$("#logomae").attr("src", _cdn+"/grafika/mae-s.png"+"?"+Math.random());
	}

	$(this).val($(this).val().toCardFormat());

    });


function zapiszdaneprzesylki(){
    $('.zapiszdaneprzesylki').click(function(){
	    var id_zam = $(this).attr('data-id');
	    var nrprzesylki = $('.nrprzesylki[data-id="'+id_zam+'"]').val();
		var nr = $('#strony').attr('data-nr');

	    $.post("./ajax/admin.html", {akcja: "zapisz", id_zam:id_zam, nrprzesylki: nrprzesylki}).done(function(data){

			if(data.trim() == "ok"){
				$.post("./ajax/admin.html", {akcja: "1", strona: nr}).done(function(data){

					$('#pokazzam').empty().append(data);
					$('#pokazzam').show();
					$('.popupadmin').empty().append("Dane przesylki zamowienia zostaly zapisane.");
					$('#zapisano').show();

					zapiszdaneprzesylki();
					stronicowanie();
				});
			}else if(data.trim() == "brak_spedytora"){
				$('.popupadmin').empty().append("Uzupelnij dane spedytora dla wybranego kraju wysylki.");
				$('#zapisano').show();
			}else{
				$('.popupadmin').empty().append("Uzupelnij numer przesylki zamowienia.");
				$('#zapisano').show();

			}
    	});
    });


    $('#zapisano a').click(function(e){
	e.preventDefault();
	$('#zapisano').hide();
    });
}

    $("#rodzajzam").change(function(){
	var opcja = $(this).find('option:selected', this).val();
	if(opcja != "0"){
		if($('#strony').length > 0){
			var nr = $('#strony').attr('data-nr');
		}else{
			var nr = 1;
		}
	    $.post("./ajax/admin.html", {akcja: opcja, strona: nr}).done(function(data){

			$('#pokazzam').empty().append(data);
			$('#pokazzam').show();

			zapiszdaneprzesylki();
			stronicowanie();
    	});
	}else{
	    $('#pokazzam').hide();
	}
    });


	$('.typ2').iCheck({
	    checkboxClass: 'icheckbox_flat-red',
	    radioClass: 'iradio_flat-red'
	});



	$('.typ1').each(function(ind, el){

		var self = $(el),
    	    label = self.next(),
    	    label_text = label.text();

	    label.remove();
	    self.iCheck({
    		checkboxClass: 'icheckbox_line-red',
    		radioClass: 'iradio_line-red',
    		insert: '<div class="icheck_line-icon"></div>' + label_text
	    });
	});



	$('.plec').iCheck('uncheck');
	$('.plec[data-selected="selected"]').iCheck('check');

	var wybrano = false;
	$('.kolory').each(function(ind, el){
			if(!wybrano && ($(el).attr("data-selected") == "selected")){
				$(el).iCheck("check");
				wybrano = true;
			}
    });

	function stronicowanie(){
	$('.strona').click(function(e){
		e.preventDefault();

		var nr = $(this).attr('data-nr');
		var opcja = $('#rodzajzam').find('option:selected', this).val();
		$('#strony').attr('data-nr', nr);

	    $.post("./ajax/admin.html", {akcja: opcja, strona: nr}).done(function(data){

			$('#pokazzam').empty().append(data);
			$('#pokazzam').show();

			zapiszdaneprzesylki();
			stronicowanie();
    	});

	});
	}

	$('.arrow-left').click(function(){
		var id = $('.tytul-opinia').attr('data-id');
		$.post("./ajax/opinia.html", {kierunek: "left", id: id}).done(function(data){
			$('.kontener-opinie').empty().append(data);
    	});
	});

	$('.arrow-right').click(function(){
		var id = $('.tytul-opinia').attr('data-id');
		$.post("./ajax/opinia.html", {kierunek: "right", id: id}).done(function(data){
			$('.kontener-opinie').empty().append(data);
    	});
	});

$(document).mouseup(function(e)
{
    var container = $(".menu-jezyk");

    // if the target of the click isn't the container nor a descendant of the container
    if (!container.is(e.target) && container.has(e.target).length === 0)
    {
        $(".wybierzjezyk").hide();
    }


});

});

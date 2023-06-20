$(document).ready(function() {
    var character = $('#character');
    var bullet = $('#bullet');
    var zombie = $('#zombie');
  
    character.draggable({
      containment: '#game-container',
      scroll: false
    });
  
    $(document).on('mousedown', function() {
      var characterPos = character.position();
      var bulletPos = {
        top: characterPos.top + character.height() / 2 - bullet.height() / 2,
        left: characterPos.left + character.width() / 2 - bullet.width() / 2
      };
      bullet.css(bulletPos).show().animate({ top: 0 }, 'fast', function() {
        $(this).hide();
      });
    });
  
    setInterval(function() {
      var bulletPos = bullet.position();
      var zombiePos = zombie.position();
      if (collision(bulletPos, zombiePos)) {
        zombie.hide();
        bullet.hide();
        alert('Bạn đã bắn trúng zombie!');
      }
    }, 10);
  
    function collision($div1, $div2) {
        var x1 = $div1.left;
        var y1 = $div1.top;
        var h1 = $div1.height;
        var w1 = $div1.width;
        var b1 = y1 + h1;
        var r1 = x1 + w1;
        var x2 = $div2.left;
        var y2 = $div2.top;
        var h2 = $div2.height;
        var w2 = $div2.width;
        var b2 = y2 + h2;
        var r2 = x2 + w2;
    
        if (b1 < y2 || y1 > b2 || r1 < x2 || x1 > r2) {
          return false;
        }
        return true;
      }
    });
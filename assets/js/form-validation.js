// 如果存在无效字段，则用于禁用表单提交的示例入门JavaScript 
(function() {
    'use strict';
    window.addEventListener('load', function() {
      // 提取所有我们要应用自定义Bootstrap验证样式的表单
      var forms = document.getElementsByClassName('needs-validation');
      // 遍历它们并阻止提交
      var validation = Array.prototype.filter.call(forms, function(form) {
        form.addEventListener('submit', function(event) {
          if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
          }
          form.classList.add('was-validated');
        }, false);
      });
    }, false);
  })();
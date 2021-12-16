</main>

<script src="https://unpkg.com/@shopify/app-bridge@2"></script>
<script>
  var AppBridge = window['app-bridge'];
  var actions = AppBridge.actions;
  var TitleBar = actions.TitleBar;
  var Button = actions.Button;
  var Redirect = actions.Redirect;
  var Modal = actions.Modal;
  const app = AppBridge.createApp({
  apiKey: '2478184ff586db088ec01e59fc6da91e',
  shopOrigin:'<?=$shopify->get_url();?>'
  });



// var breadcrumb = Button.create(app, { label: 'My breadcrumb' });
// breadcrumb.subscribe(Button.Action.CLICK, function() {
//   app.dispatch(Redirect.toApp({ path: '/breadcrumb-link' }));
// });
//
var myButton = Button.create(app, {label: 'Open Modal'});
var titleBarOptions = {
  title: 'App',
  buttons: {
    primary:myButton
  }
};

var myTitleBar = TitleBar.create(app, titleBarOptions);
const modalOptions = {
  title: 'My Modal',
  message: "Hello World"
};
const myModal = Modal.create(app, modalOptions);
myButton.subscribe(Button.Action.CLICK, data => {
myModal.dispatch(Modal.Action.OPEN);
});
// const modalOptions = {
//   title: 'My Modal',
//   message: "Hello World",
//   url: 'http://example.com',
// };
//
//
// okButton.subscribe(Button.Action.CLICK, () => {
//   myModal.dispatch(Modal.Action.OPEN);
// });



</script>
</body>
</html>

<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('hcs/Controller.php');

$palavra = new Palavras();
var_dump($palavra->silabas('conflito'));
?>

<!DOCTYPE html>
<html>
<head>
  <!-- Standard Meta -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

  <!-- Site Properties -->
  <title>Bootstrap - Semantic</title>
  <link rel="stylesheet" type="text/css" href="https://semantic-ui.com/dist/semantic.css">

  <link rel="stylesheet" type="text/css" href="https://semantic-ui.com/dist/components/reset.css">
  <link rel="stylesheet" type="text/css" href="https://semantic-ui.com/dist/components/site.css">

  <link rel="stylesheet" type="text/css" href="https://semantic-ui.com/dist/components/container.css">
  <link rel="stylesheet" type="text/css" href="https://semantic-ui.com/dist/components/grid.css">
  <link rel="stylesheet" type="text/css" href="https://semantic-ui.com/dist/components/header.css">
  <link rel="stylesheet" type="text/css" href="https://semantic-ui.com/dist/components/image.css">
  <link rel="stylesheet" type="text/css" href="https://semantic-ui.com/dist/components/menu.css">

  <link rel="stylesheet" type="text/css" href="https://semantic-ui.com/dist/components/divider.css">
  <link rel="stylesheet" type="text/css" href="https://semantic-ui.com/dist/components/list.css">
  <link rel="stylesheet" type="text/css" href="https://semantic-ui.com/dist/components/segment.css">
  <link rel="stylesheet" type="text/css" href="https://semantic-ui.com/dist/components/dropdown.css">
  <link rel="stylesheet" type="text/css" href="https://semantic-ui.com/dist/components/icon.css">
  <link rel="stylesheet" type="text/css" href="https://semantic-ui.com/dist/components/transition.css">


  <script src="https://semantic-ui.com/examples/assets/library/jquery.min.js"></script>
  <script src="https://semantic-ui.com/dist/semantic.js"></script>	
  <script src="https://semantic-ui.com/dist/components/transition.js"></script>
  <script src="https://semantic-ui.com/dist/components/dropdown.js"></script>
  <script src="https://semantic-ui.com/dist/components/visibility.js"></script>


  <script>
  $(document)
    .ready(function() {
      $('.ui.selection.dropdown').dropdown();
      $('.ui.menu .ui.dropdown').dropdown({
        on: 'hover'
      });
    })
  ;
  </script>

<script>
  $(document)
    .ready(function() {

      // fix main menu to page on passing
      $('.main.menu').visibility({
        type: 'fixed'
      });
      $('.overlay').visibility({
        type: 'fixed',
        offset: 80
      });

      // lazy load images
      $('.image').visibility({
        type: 'image',
        transition: 'vertical flip in',
        duration: 500
      });

      // show dropdown on hover
      $('.main.menu  .ui.dropdown').dropdown({
        on: 'hover'
      });
    })
  ;
  </script>

  <style type="text/css">

  body {
    background-color: #FFFFFF;
  }
  .main.container {
    margin-top: 2em;
  }

  .main.menu {
    margin-top: 4em;
    border-radius: 0;
    border: none;
    box-shadow: none;
    transition:
      box-shadow 0.5s ease,
      padding 0.5s ease
    ;
  }
  .main.menu .item img.logo {
    margin-right: 1.5em;
  }

  .overlay {
    float: left;
    margin: 0em 3em 1em 0em;
  }
  .overlay .menu {
    position: relative;
    left: 0;
    transition: left 0.5s ease;
  }

  .main.menu.fixed {
    background-color: #FFFFFF;
    border: 1px solid #DDD;
    box-shadow: 0px 3px 5px rgba(0, 0, 0, 0.2);
  }
  .overlay.fixed .menu {
    left: 800px;
  }

  .text.container .left.floated.image {
    margin: 2em 2em 2em -4em;
  }
  .text.container .right.floated.image {
    margin: 2em -4em 2em 2em;
  }

  .ui.footer.segment {
    margin: 5em 0em 0em;
    padding: 5em 0em;
  }
  </style>


</head>
<body>


  <div class="ui main text container">
    <h1 class="ui header">Sticky Example</h1>
    <p>This example shows how to use lazy loaded images, a sticky menu, and a simple text container</p>
  </div>


  <div class="ui borderless main menu">
    <div class="ui text container">
      <div class="header item">
        <img class="logo" src="https://semantic-ui.com/examples/assets/images/logo.png">
        Project Name
      </div>
      <a href="#" class="item">Blog</a>
      <a href="#" class="item">Articles</a>
      <a href="#" class="ui right floated dropdown item">
        Dropdown <i class="dropdown icon"></i>
        <div class="menu">
          <div class="item">Link Item</div>
          <div class="item">Link Item</div>
          <div class="divider"></div>
          <div class="header">Header Item</div>
          <div class="item">
            <i class="dropdown icon"></i>
            Sub Menu
            <div class="menu">
              <div class="item">Link Item</div>
              <div class="item">Link Item</div>
            </div>
          </div>
          <div class="item">Link Item</div>
        </div>
      </a>
    </div>
  </div>

<div class="ui grid container">
  <div class="row">
    <div class="column">
      <h1 class="ui header">Bootstrap Migration</h1>
    </div>
  </div>
  <div class="row">
    <div class="column">
      <div class="ui message">
        <h1 class="ui header">Hello, world!</h1>
        <p>This is a template for a simple marketing or informational website. It includes a large callout called a jumbotron and three supporting pieces of content. Use it as a starting point to create something more unique.</p>
        <a class="ui blue button">Learn more &raquo;</a>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="column">
      <h1 class="ui header">Buttons</h1>
      <a class="ui button" tabindex="0">
        Default
      </a>
      <a class="ui primary button" tabindex="0">
        Primary
      </a>
      <a class="ui basic button" tabindex="0">
        Basic
      </a>
      <a class="ui positive button" tabindex="0">
        Success
      </a>
      <a class="ui negative button" tabindex="0">
        Error
      </a>
    </div>
  </div>
  <div class="row">
    <div class="column">
      <h1 class="ui header">Thumbnails</h1>
      <div class="ui divider"></div>
      <img class="ui small image" src="assets/images/wireframe/image.png">
    </div>
  </div>
  <div class="row">
    <div class="column">
      <h1 class="ui header">Dropdown</h1>
      <div class="ui divider"></div>
      <div class="ui selection dropdown">
        <input type="hidden" name="selection">
        <i class="dropdown icon"></i>
        <div class="default text">Select</div>
        <div class="menu">
          <div class="item" data-value="male">Male</div>
          <div class="item" data-value="female">Female</div>
        </div>
      </div>
      <div class="ui vertical menu">
        <a class="active item">
          Friends
        </a>
        <a class="item">
          Messages
        </a>
        <div class="ui dropdown item">
          <i class="dropdown icon"></i>
          More
          <div class="menu">
            <a class="item">Edit Profile</a>
            <a class="item">Choose Language</a>
            <a class="item">Account Settings</a>
          </div>
        </div>
      </div>

      <div class="ui dropdown">
        <div class="visible menu">
          <div class="header">Categories</div>
          <div class="item">
            <i class="dropdown icon"></i>
            <span class="text">Clothing</span>
            <div class="menu">
              <div class="header">Men's</div>
              <div class="item">Shirts</div>
              <div class="item">Pants</div>
              <div class="item">Jeans</div>
              <div class="item">Shoes</div>
              <div class="divider"></div>
              <div class="header">Women's</div>
              <div class="item">Dresses</div>
              <div class="item">Shoes</div>
              <div class="item">Bags</div>
            </div>
          </div>
          <div class="item">Home Goods</div>
          <div class="item">Bedroom</div>
          <div class="divider"></div>
          <div class="header">Order</div>
          <div class="item">Status</div>
          <div class="item">Cancellations</div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="column">
      <h1 class="ui header">Badges</h1>
      <div class="ui divider"></div>
      <div class="ui vertical menu">
        <div class="item">
          One <span class="ui label">2</span>
        </div>
        <div class="item">
          Two <span class="ui label">2</span>
        </div>
        <div class="item">
          Three <span class="ui label">2</span>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="column">
      <h1 class="ui header">Tables</h1>
      <div class="ui two column grid">
        <div class="column">
          <table class="ui table">
            <thead>
              <tr>
                <th>Name</th>
                <th>Premium Plan</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>John</td>
                <td>No</td>
              </tr>
              <tr>
                <td>Jamie</td>
                <td>Yes</td>
              </tr>
              <tr>
                <td>Jill</td>
                <td>Yes</td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="column">
          <table class="ui basic table">
            <thead>
              <tr>
                <th>Name</th>
                <th>Premium Plan</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>John</td>
                <td>No</td>
              </tr>
              <tr>
                <td>Jamie</td>
                <td>Yes</td>
              </tr>
              <tr>
                <td>Jill</td>
                <td>Yes</td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="column">
          <table class="ui definition table">
            <thead>
              <tr>
                <th>Name</th>
                <th>Premium Plan</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>John</td>
                <td>No</td>
              </tr>
              <tr>
                <td>Jamie</td>
                <td>Yes</td>
              </tr>
              <tr>
                <td>Jill</td>
                <td>Yes</td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="column">
          <table class="ui very basic table">
            <thead>
              <tr>
                <th>Name</th>
                <th>Premium Plan</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>John</td>
                <td>No</td>
              </tr>
              <tr>
                <td>Jamie</td>
                <td>Yes</td>
              </tr>
              <tr>
                <td>Jill</td>
                <td>Yes</td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="sixteen wide column">
          <table class="ui celled structured table">
            <thead>
              <tr>
                <th rowspan="2">Name</th>
                <th rowspan="2">Type</th>
                <th rowspan="2">Files</th>
                <th colspan="3">Languages</th>
              </tr>
              <tr>
                <th>Ruby</th>
                <th>JavaScript</th>
                <th>Python</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Alpha Team</td>
                <td>Project 1</td>
                <td>2</td>
                <td>
                  <i class="large green checkmark icon"></i>
                </td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td rowspan="3">Beta Team</td>
                <td>Project 1</td>
                <td>52</td>
                <td>
                  <i class="large green checkmark icon"></i>
                </td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td>Project 2</td>
                <td>12</td>
                <td></td>
                <td>
                  <i class="large green checkmark icon"></i>
                </td>
                <td></td>
              </tr>
              <tr>
                <td>Project 3</td>
                <td>21</td>
                <td>
                  <i class="large green checkmark icon"></i>
                </td>
                <td></td>
                <td></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="column">
      <h1 class="ui header">Alerts</h1>
      <div class="ui divider"></div>
      <div class="ui positive message">Well done! You successfully read this important alert message.</div>
      <div class="ui info message">Heads up! This alert needs your attention, but it's not super important.</div>
      <div class="ui warning message">Warning! Best check yo self, you're not looking too good.</div>
      <div class="ui error message">Oh snap! Change a few things up and try submitting again.</div>
    </div>
  </div>
  <div class="row">
    <div class="column">
      <h1 class="ui header">List groups</h1>
      <div class="ui divider"></div>
      <div class="ui three column grid">
        <div class="column">
          <div class="ui segments">
            <div class="ui segment">
              <p>Cras justo odio</p>
            </div>
            <div class="ui segment">
              <p>Dapibus ac facilisis in</p>
            </div>
            <div class="ui segment">
              <p>Morbi leo risus</p>
            </div>
            <div class="ui segment">
              <p>Porta ac consectetur ac</p>
            </div>
            <div class="ui segment">
             <p>Vestibulum at eros</p>
           </div>
         </div>
        </div>
        <div class="column">
          <div class="ui fluid vertical menu">
            <a class="item">
              <p>Cras justo odio</p>
            </a>
            <a class="item">
             <p>Vestibulum at eros</p>
            </a>
          </div>
        </div>
        <div class="column">
          <div class="ui fluid vertical menu">
            <a class="item">
              <h1 class="ui medium header">List group item heading</h1>
              <p>Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
            </a>
            <a class="item">
              <h1 class="ui medium header">List group item heading</h1>
              <p>Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
            </a>
            <a class="item">
              <h1 class="ui medium header">List group item heading</h1>
              <p>Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="column">
      <h1 class="ui header">Panels</h1>
      <div class="ui divider"></div>
      <div class="ui three column grid">
        <div class="column">
          <div class="ui segments">
            <div class="ui red segment">One</div>
            <div class="ui blue segment">Two</div>
            <div class="ui green segment">Three</div>
          </div>
        </div>
        <div class="column">
          <div class="ui raised segments">
            <div class="ui segment">One</div>
            <div class="ui segment">Two</div>
            <div class="ui segment">Three</div>
          </div>
        </div>
        <div class="column">
          <div class="ui stacked segments">
            <div class="ui segment">One</div>
            <div class="ui segment">Two</div>
            <div class="ui segment">Three</div>
          </div>
        </div>
        <div class="column">
          <div class="ui top attached error message">Error</div>
          <div class="ui bottom attached segment">Panel content</div>
        </div>
        <div class="column">
          <div class="ui top attached info message">Info</div>
          <div class="ui bottom attached segment">Panel content</div>
        </div>
        <div class="column">
          <div class="ui top attached success message">Success</div>
          <div class="ui bottom attached segment">Panel content</div>
        </div>
        <div class="column">
          <h4 class="ui top attached inverted header">Header</h4>
          <div class="ui bottom attached segment">Panel content</div>
        </div>
        <div class="column">
          <h4 class="ui top attached block header">Header</h4>
          <div class="ui bottom attached segment">Panel content</div>
        </div>
        <div class="column">
          <h4 class="ui top attached header">Header</h4>
          <div class="ui bottom attached segment">Panel content</div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="column">
      <h1 class="ui header">Wells</h1>
      <div class="ui divider"></div>
      <div class="ui segment">
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas sed diam eget risus varius blandit sit amet non magna. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Cras mattis consectetur purus sit amet fermentum. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Aenean lacinia bibendum nulla sed consectetur.</p>
      </div>
      <div class="ui secondary segment">
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas sed diam eget risus varius blandit sit amet non magna. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Cras mattis consectetur purus sit amet fermentum. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Aenean lacinia bibendum nulla sed consectetur.</p>
      </div>
      <div class="ui tertiary segment">
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas sed diam eget risus varius blandit sit amet non magna. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Cras mattis consectetur purus sit amet fermentum. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Aenean lacinia bibendum nulla sed consectetur.</p>
      </div>
      <div class="ui inverted segment">
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas sed diam eget risus varius blandit sit amet non magna. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Cras mattis consectetur purus sit amet fermentum. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Aenean lacinia bibendum nulla sed consectetur.</p>
      </div>
      <div class="ui secondary inverted segment">
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas sed diam eget risus varius blandit sit amet non magna. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Cras mattis consectetur purus sit amet fermentum. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Aenean lacinia bibendum nulla sed consectetur.</p>
      </div>
      <div class="ui tertiary inverted segment">
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas sed diam eget risus varius blandit sit amet non magna. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Cras mattis consectetur purus sit amet fermentum. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Aenean lacinia bibendum nulla sed consectetur.</p>
      </div>
    </div>
  </div>
</div>

</body>

</html>
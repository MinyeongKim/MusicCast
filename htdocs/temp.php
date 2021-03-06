<html>
<head>
<style type = "text/css">
body {
  background: rgb(100,100,130)
}

* {
  box-sizing: border-box;
}

#container {
  margin: 0 auto;
  display: block;
  margin-top: 100px;
  width: 42px;
  height: 42px;
  border: solid 1px rgba(0,0,10,0.5);
  border-radius: 5px;
  position: relative;
  
  & label {
    height: 40px;
    width: 40px;
    z-index: 0;
    display: inline-block;
    position: absolute;
    top: 0;
    left: 0;
    
    & div {
      height: 20px;
      width: 20px;
      border: solid 2px rgba(0,0,10,0.6);
      margin: 10px;
      border-radius: 50%;
      transform: rotate(45deg);
      
      transition: all 100ms ease-in-out, border 50ms ease 100ms;
    }
  }
  
  & input {
    height: 40px;
    width: 40px;
    margin: 0;
    opacity: 0;
    z-index: 1;
    position: relative;
    cursor: pointer;
     
    &:checked + label > div {
      border-radius: 0;
      border-top: 0;
      border-left: 0;
      border-color: rgba(240,240,240,0.9);
      height: 25px;
      width: 15px;
      margin-top: 3px;
      margin-left: 14px;
      transform: rotate(40deg);
      
      transition: all 150ms ease-in-out;
    }
  }
}
</style>
</head>

<body>
<div id="container">
  <input type="checkbox" name="check">
  <label for="check"><div></div></label>
</div>
</body>
</html>
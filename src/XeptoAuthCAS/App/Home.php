<?php namespace XeptoAuthCAS\App;

use Xepto;

class Home
{
    use Xepto\Dependency\Injector;

    public function get()
     {
        echo '<pre>'.yaml_emit($this->token->getIdent()).'</pre>';

        echo '<a href="/auth.login">Login</a><br/>';
        echo '<a href="/auth.logout">Logout</a><br/>';

        echo $this->config->cas['ca'];

     }

    public function post()
     {

         echo $this->request->raw();

     }
}

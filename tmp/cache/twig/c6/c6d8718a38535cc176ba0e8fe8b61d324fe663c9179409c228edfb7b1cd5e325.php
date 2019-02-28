<?php

/* login.twig */
class __TwigTemplate_88b2fa13246481282397f1f8c44ce49e6d1b6a70ef6b81790ea6a4027c10c1ef extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 1
        echo "<html lang=\"en\">
<head>
    <meta charset=\"utf-8\">
    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
    <meta name=\"description\" content=\"\">
    <meta name=\"author\" content=\"\">
    <title>F3 Sample Project Login Page</title>
    <link rel=\"stylesheet\"
          href=\"https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css\"
          integrity=\"sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T\"
          crossorigin=\"anonymous\">
</head>

<body>

<div class=\"container\">
    <div class=\"row\">
        <div class=\"col-md-6 offset-md-3\">
            ";
	    // line 20
        if (call_user_func_array($this->env->getFilter('f3')->getCallable(), ["MESSAGES"])) {
	        // line 21
	        echo "                <div id=\"messages\">
                    ";
	        // line 22
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(call_user_func_array($this->env->getFilter('f3')->getCallable(), ["MESSAGES"]));
            foreach ($context['_seq'] as $context["type"] => $context["msg_arr"]) {
	            // line 23
	            echo "                        ";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($context["msg_arr"]);
                foreach ($context['_seq'] as $context["_key"] => $context["msg"]) {
	                // line 24
	                echo "                            <div class=\"alert alert-";
                    if ((twig_lower_filter($this->env, $context["type"]) == "error")) {
                        echo "danger";
                    } else {
                        echo twig_escape_filter($this->env, twig_lower_filter($this->env, $context["type"]), "html", null, true);
                    }
                    echo " alert-dismissible";
                    if (twig_get_attribute($this->env, $this->source, $context["msg"], "one_time", [])) {
                        echo " alert-one-time";
                    }
	                echo " d-flex align-items-center\"
                                 role=\"alert\">
                                <div>
                                    ";
                    // line 27
                    if (twig_get_attribute($this->env, $this->source, $context["msg"], "one_time", [])) {
                        // line 28
	                    echo "                                        <button type=\"button\" class=\"close\"
                                                data-dismiss=\"alert\" data-code=\"msg-shown-";
                        // line 29
                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["msg"], "code", []), "html", null, true);
                        echo "\"
                                                aria-label=\"Close\">
                                            <span aria-hidden=\"true\">&times;</span></button>
                                    ";
                    }
                    // line 33
	                echo "                                    ";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["msg"], "message", []), "html", null, true);
                    echo "
                                </div>
                            </div>
                        ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['msg'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 37
	            echo "                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['type'], $context['msg_arr'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 38
	        echo "                </div>
            ";
        }
        // line 40
	    echo "            <form class=\"form-signin\" method=\"POST\" action=\"/authenticate\">
                <h2 class=\"form-signin-heading\">Please sign in</h2>
                <div class=\"form-group\">
                    <label for=\"inputUsername\" class=\"sr-only\">Username</label>
                    <input type=\"text\"
                           id=\"inputUsername\"
                           name=\"username\"
                           class=\"form-control\"
                           placeholder=\"Username\"
                           required=\"\">
                </div>
                <div class=\"form-group\">
                    <label for=\"inputPassword\" class=\"sr-only\">Password</label>
                    <input type=\"password\"
                           id=\"inputPassword\"
                           name=\"password\"
                           class=\"form-control\"
                           placeholder=\"Password\"
                           required=\"\">
                </div>
                <button class=\"btn btn-primary\" type=\"submit\">Sign in</button>
            </form>
        </div>
    </div>
</div>

</body>
</html>


";
    }

    public function getTemplateName()
    {
        return "login.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
	    return array(106 => 40, 102 => 38, 96 => 37, 85 => 33, 78 => 29, 75 => 28, 73 => 27, 58 => 24, 53 => 23, 49 => 22, 46 => 21, 44 => 20, 23 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("<html lang=\"en\">
<head>
    <meta charset=\"utf-8\">
    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
    <meta name=\"description\" content=\"\">
    <meta name=\"author\" content=\"\">
    <title>F3 Sample Project Login Page</title>
    <link rel=\"stylesheet\"
          href=\"https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css\"
          integrity=\"sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T\"
          crossorigin=\"anonymous\">
</head>

<body>

<div class=\"container\">
    <div class=\"row\">
        <div class=\"col-md-6 offset-md-3\">
            {% if \"MESSAGES\"|f3 %}
                <div id=\"messages\">
                    {% for type, msg_arr in \"MESSAGES\"|f3 %}
                        {% for msg in msg_arr %}
                            <div class=\"alert alert-{% if type|lower == 'error' %}danger{% else %}{{ type|lower }}{% endif %} alert-dismissible{% if msg.one_time %} alert-one-time{% endif %} d-flex align-items-center\"
                                 role=\"alert\">
                                <div>
                                    {% if msg.one_time %}
                                        <button type=\"button\" class=\"close\"
                                                data-dismiss=\"alert\" data-code=\"msg-shown-{{ msg.code }}\"
                                                aria-label=\"Close\">
                                            <span aria-hidden=\"true\">&times;</span></button>
                                    {% endif %}
                                    {{ msg.message }}
                                </div>
                            </div>
                        {% endfor %}
                    {% endfor %}
                </div>
            {% endif %}
            <form class=\"form-signin\" method=\"POST\" action=\"/authenticate\">
                <h2 class=\"form-signin-heading\">Please sign in</h2>
                <div class=\"form-group\">
                    <label for=\"inputUsername\" class=\"sr-only\">Username</label>
                    <input type=\"text\"
                           id=\"inputUsername\"
                           name=\"username\"
                           class=\"form-control\"
                           placeholder=\"Username\"
                           required=\"\">
                </div>
                <div class=\"form-group\">
                    <label for=\"inputPassword\" class=\"sr-only\">Password</label>
                    <input type=\"password\"
                           id=\"inputPassword\"
                           name=\"password\"
                           class=\"form-control\"
                           placeholder=\"Password\"
                           required=\"\">
                </div>
                <button class=\"btn btn-primary\" type=\"submit\">Sign in</button>
            </form>
        </div>
    </div>
</div>

</body>
</html>


", "login.twig", "D:\\OpenServer\\domains\\f3-mvc\\app\\views\\login.twig");
    }
}

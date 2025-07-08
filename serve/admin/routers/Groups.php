<?php

namespace serve\admin\routers;

class Groups
{
    function list()
    {
        return ['\serve\admin\controllers\Groups', 'list'];
    }
}

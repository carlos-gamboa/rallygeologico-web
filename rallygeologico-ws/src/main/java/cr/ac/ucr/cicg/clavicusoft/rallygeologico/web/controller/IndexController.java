package cr.ac.ucr.cicg.clavicusoft.rallygeologico.web.controller;

import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.servlet.ModelAndView;

@Controller
public class IndexController {

    @RequestMapping("/index.html")
    public ModelAndView getIndex(){
        return new ModelAndView("index");
    }
}

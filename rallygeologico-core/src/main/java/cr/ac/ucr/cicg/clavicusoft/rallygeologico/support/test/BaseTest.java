package cr.ac.ucr.cicg.clavicusoft.rallygeologico.support.test;

import org.slf4j.Logger;
import org.slf4j.LoggerFactory;
import org.springframework.test.context.ContextConfiguration;

/**
 * Base class for all the tests running against a Spring Bean Factory Container.
 */
@ContextConfiguration(locations = {
        "/rallygeologico-core.spring.xml",
        "/rallygeologico-hibernate.spring.xml",
        "/rallygeologico-security.spring.xml"
})
public abstract class BaseTest {

    protected transient final Logger logger = LoggerFactory.getLogger(getClass());

}

package cr.ac.ucr.cicg.clavicusoft.rallygeologico.ws.rest.support.cors;


import com.sun.jersey.spi.container.ContainerRequest;
import com.sun.jersey.spi.container.ContainerResponse;
import com.sun.jersey.spi.container.ContainerResponseFilter;

import javax.ws.rs.core.Response;
import javax.ws.rs.core.Response.ResponseBuilder;

/**
 * An implementation of a {@link ContainerResponseFilter} for allowing CORS access for all WS requests.
 *
 */

public class CorsJerseyFilter implements ContainerResponseFilter{

    @Override
    public ContainerResponse filter(ContainerRequest req, ContainerResponse contResp){

        String originHeaderValue = req.getHeaderValue("Origin");
        if(originHeaderValue != null){
            ResponseBuilder resp = Response.fromResponse(contResp.getResponse());
            resp.header("Access-Control-Allow-Origin", originHeaderValue)
                    .header("Access-Control-Allow-Credentials", "true")
                    .header("Access-Control-Allow-Methods", "GET, POST, DELETE, PUT, OPTIONS, ACCEPT");

            resp.header("Access-Control-Allow-Headers", "Content-Type, Origin, Authorization");

            contResp.setResponse(resp.build());
        }
        return contResp;
    }
}
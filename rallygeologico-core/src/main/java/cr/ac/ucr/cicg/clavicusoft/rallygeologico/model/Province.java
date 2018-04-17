package cr.ac.ucr.cicg.clavicusoft.rallygeologico.model;

import javax.persistence.*;
import java.util.Set;

@Entity
@Table(name = "Province")
public class Province extends BasicEntity{

    @Id
    @Column(name="Name")
    private String name;

    @OneToMany(mappedBy = "relatedCantons")
    private Set<Canton> cantons;

    @OneToMany(mappedBy = "relatedSites")
    private Set<Site> sites;

    @Override
    public boolean onEquals(Object o) {
        return false;
    }

    @Override
    public int onHashCode(int result) {
        return 0;
    }
}

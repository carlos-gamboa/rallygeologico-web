package cr.ac.ucr.cicg.clavicusoft.rallygeologico.model;

import javax.persistence.*;
import java.util.Set;

@Entity
@Table(name = "Rally")
public class Rally extends BasicEntity{

    @Id
    @Column(name="RallyId")
    private String rallyId;

    @Column(name="Name")
    private String name;

    @Column(name="Description")
    private String description;

    @Column(name="PointsAwarded")
    private int pointsAwarded;

    @Column(name="ImageUrl")
    private String imageUrl;

    @ManyToMany(mappedBy = "relatedSites")
    private Set<Site> sites;

    @OneToMany(mappedBy = "relatedCompetitions")
    private Set<Competition> competitions;

    @Override
    public boolean onEquals(Object o) {
        return false;
    }

    @Override
    public int onHashCode(int result) {
        return 0;
    }
}

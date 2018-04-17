package cr.ac.ucr.cicg.clavicusoft.rallygeologico.model;

import javax.persistence.*;
import java.util.Set;

@Entity
@Table(name = "Site")
public class Site extends BasicEntity{

    @Id
    @Column(name="SiteId")
    private String siteId;

    @Column(name="Name")
    private String name;

    @Column(name="PointsAwarded")
    private int pointsAwarded;

    @Column(name="QrUrl")
    private String qrUrl;

    @Column(name="Details")
    private String details;

    @Column(name="Description")
    private String description;

    @Column(name="Longitude")
    private String longitude;

    @Column(name="Latitude")
    private String latitude;

    @ManyToOne
    private Province province;

    @ManyToMany(mappedBy = "RelatedTerms")
    private Set<Term> terms;

    @ManyToMany(mappedBy = "RelatedCompetitionStatistics")
    private Set<CompetitionStatistics> competitionStatistics;

    @Override
    public boolean onEquals(Object o) {
        return false;
    }

    @Override
    public int onHashCode(int result) {
        return 0;
    }
}

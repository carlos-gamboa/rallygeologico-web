package cr.ac.ucr.cicg.clavicusoft.rallygeologico.model;

import javax.persistence.*;

@Entity
@Table(name = "District")
public class District extends BasicEntity {

    @Id
    @Column(name="Name")
    private String name;

    @ManyToOne
    private Canton canton;

    @Override
    public boolean onEquals(Object o) {
        return false;
    }

    @Override
    public int onHashCode(int result) {
        return 0;
    }
}

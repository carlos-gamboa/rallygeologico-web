export class Options {
	id: number;
	activity_id: number;
	is_correct: number;
	option_text: string;

	constructor(options: any){
		this.id = option.id;
		this.activity_id = option.activity_id;
		this.is_correct = option.is_correct;
		this.option_text = option.option_text;
	}
}
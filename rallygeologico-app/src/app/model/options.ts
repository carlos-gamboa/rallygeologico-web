export class Options {
	id: number;
	activity_id: number;
	is_correct: number;
	option_text: string;

	constructor(options: any){
		this.id = options.id;
		this.activity_id = options.activity_id;
		this.is_correct = options.is_correct;
		this.option_text = options.option_text;
	}
}